<?php
/**
 * Proxies the CCTV landing page to the Railway-hosted redesign.
 * Browser URL stays on zoorepairs.com.au; JS/CSS load from Railway
 * directly (see assetPrefix in the Next.js app's next.config.ts).
 */
add_action('template_redirect', function () {
    $target_path = '/computer-services/cctv-security-cameras-installation-brisbane/';
    $request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (rtrim($request_path, '/') . '/' !== $target_path) {
        return;
    }

    $railway_url = 'https://RAILWAY_URL/cctv-security-cameras-installation-brisbane';

    $response = wp_remote_get($railway_url, ['timeout' => 10]);

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return; // fall through to the normal WP page on failure
    }

    header('Content-Type: text/html; charset=UTF-8');
    echo wp_remote_retrieve_body($response);
    exit;
});
