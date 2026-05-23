<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SecurityHeadersMiddleware
 *
 * CSP bersifat DINAMIS berdasarkan APP_ENV:
 *
 * [local / development]
 *   Mengizinkan Vite dev server sepenuhnya:
 *   - script-src    + Vite origins + 'unsafe-eval' (HMR, dynamic import)
 *   - style-src-elem + Vite origins + 'unsafe-inline' (<style> tag inject)
 *   - style-src-attr + 'unsafe-inline' (inline style="" di Blade views)
 *   - connect-src   + Vite origins + WebSocket ws:// (HMR live reload)
 *   - worker-src    + blob: (Vite internal worker)
 *
 * [production]
 *   CSP ketat: tidak ada izin Vite, tidak ada 'unsafe-eval'.
 *   Asset sudah di-build menjadi file statis dari domain sendiri.
 *
 * Referensi: OWASP Secure Headers Project, ZAP Passive Scan Rules
 */
class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', $this->buildCsp());
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=(), interest-cohort=()'
        );
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }

    private function buildCsp(): string
    {
        $isLocal = app()->environment(['local', 'development']);

        if ($isLocal) {
            return $this->localCsp();
        }

        return $this->productionCsp();
    }

    /**
     * CSP untuk development — permisif terhadap Vite dev server.
     *
     * Vite (saat `npm run dev`) membutuhkan:
     * - script-src    : memuat /@vite/client dan JS module dari port 5173
     * - 'unsafe-eval' : Vite HMR & source map menggunakan eval() / new Function()
     * - style-src-elem: Vite inject <style> tag via JavaScript saat HMR
     * - style-src-attr: inline style="..." pada elemen HTML di Blade views
     * - connect-src   : fetch & EventSource ke Vite server untuk HMR polling
     * - ws://         : WebSocket connection untuk live reload
     * - worker-src    : Vite menggunakan blob: URL untuk internal worker
     */
    private function localCsp(): string
    {
        // Baca URL Vite dari file public/hot (otomatis dibuat oleh Laravel Vite plugin)
        $viteUrl = 'http://127.0.0.1:5173';
        if (file_exists(public_path('hot'))) {
            $viteUrl = trim(file_get_contents(public_path('hot')));
        }
        
        $parsedUrl = parse_url($viteUrl);
        $port = isset($parsedUrl['port']) ? $parsedUrl['port'] : 5173;

        $vite   = "http://localhost:{$port} http://127.0.0.1:{$port}";
        $viteWs = "ws://localhost:{$port} ws://127.0.0.1:{$port}";

        return implode('; ', [
            "default-src 'self'",

            // Script element (<script src="...">): Vite modules + CDN
            // Harus eksplisit agar browser tidak pakai script-src sebagai fallback
            "script-src-elem 'self' 'unsafe-inline' cdn.jsdelivr.net {$vite}",

            // Script attribute (onclick="..." dll) — biasanya tidak dipakai
            "script-src-attr 'unsafe-inline'",

            // Fallback script-src (dipakai browser lama yang tidak kenal script-src-elem)
            // + 'unsafe-eval' untuk Vite HMR source maps
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' cdn.jsdelivr.net {$vite}",

            // Style element (<style> / <link rel="stylesheet">): Vite CSS injection + CDN
            "style-src-elem 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com {$vite}",

            // Style attribute (inline style="..."): banyak dipakai di Blade views
            "style-src-attr 'unsafe-inline'",

            // Fallback style-src
            "style-src 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com {$vite}",

            "font-src 'self' cdn.jsdelivr.net fonts.gstatic.com data:",
            "img-src 'self' data: blob: picsum.photos ui-avatars.com",

            // Connect: fetch/EventSource ke Vite + WebSocket HMR
            "connect-src 'self' {$vite} {$viteWs}",

            // Worker: Vite pakai blob: URL untuk internal worker thread
            "worker-src 'self' blob:",

            "frame-ancestors 'none'",
            "form-action 'self'",
            "base-uri 'self'",
        ]);
    }

    /**
     * CSP untuk production — ketat, tanpa izin Vite.
     * Asset sudah di-build jadi file statis yang di-serve dari domain sendiri.
     */
    private function productionCsp(): string
    {
        return implode('; ', [
            "default-src 'self'",
            "script-src-elem 'self' 'unsafe-inline' cdn.jsdelivr.net",
            "script-src-attr 'none'",
            "script-src 'self' 'unsafe-inline' cdn.jsdelivr.net",
            "style-src-elem 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com",
            "style-src-attr 'unsafe-inline'",
            "style-src 'self' 'unsafe-inline' cdn.jsdelivr.net fonts.googleapis.com",
            "font-src 'self' cdn.jsdelivr.net fonts.gstatic.com",
            "img-src 'self' data: blob: picsum.photos ui-avatars.com",
            "connect-src 'self'",
            "worker-src 'self' blob:",
            "frame-ancestors 'none'",
            "form-action 'self'",
            "base-uri 'self'",
        ]);
    }

}
