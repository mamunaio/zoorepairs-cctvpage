import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

export default defineConfig({
  site: 'https://cctv.zoorepairs.com.au',
  trailingSlash: 'never',
  integrations: [sitemap()],
});
