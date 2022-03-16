<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Widget;
use Illuminate\Support\Facades\DB;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::insert("INSERT INTO `widgets` (`id`, `name`, `path`, `widget_type`, `data_limit`, `limit_required`, `taxonomy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
        (1, 'Footer: Main Footer', 'footer', 'Footer', NULL, '0', NULL, 1, NULL, NULL, NULL),
        (2, 'Header: Main Header', 'header', 'Header', NULL, '0', NULL, 0, NULL, NULL, NULL),
        (3, 'Advertisement: Advertisement HTML', 'advertisement-html', 'Advertisement', NULL, '0', NULL, 0, NULL, NULL, NULL),
        (4, 'Video: Video Slider', 'video-slider', 'Video', NULL, '1', NULL, 0, NULL, NULL, NULL),
        (5, 'HTML: Plain HTML Widget', 'html-plain', 'HTML', NULL, '0', NULL, 1, '2021-11-27 16:13:13', '2021-11-27 16:13:13', NULL),
        (6, 'Slider: Horizontal Slider', 'slider-horizontal', 'Slider', NULL, '1', NULL, 1, '2021-11-27 16:16:57', '2021-11-27 16:16:57', NULL),
        (7, 'Footer: Footer 3', 'footer-three', 'Footer', NULL, '0', NULL, 1, '2021-11-27 16:20:39', '2021-11-27 16:20:39', NULL),
        (8, 'Category: Multiple post list Top Image', 'category-multiple-post', 'Category', NULL, '1', NULL, 1, '2021-11-27 16:22:21', '2021-11-27 16:22:21', NULL),
        (9, 'Header: Header Logo Right', 'header-header-logo-right', 'Header', NULL, '0', NULL, 1, '2021-11-27 22:45:30', '2021-11-27 22:45:30', NULL),
        (10, 'Footer: Footer 1', 'footer-footer-1', 'Footer', NULL, '0', NULL, 1, '2021-11-28 10:02:28', '2021-11-28 10:02:28', NULL),
        (11, 'Category: Multiple post 2', 'category-multiple-post-2', 'category', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (12, 'Heading News: Single Post Top Image-1', 'post-renderer-single-top-image-1', 'Heading News', NULL, '1', 'post', 1, NULL, NULL, NULL),
        (13, 'Heading News: Single Post Top Image-2', 'post-renderer-single-top-image-2', 'Heading News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (14, 'Heading News: Main Highlights News', 'post-renderer-single-main', 'Heading News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (15, 'Heading News: Voice Live Tv', 'live-tv', 'Heading News', NULL, '0', NULL, 1, NULL, NULL, NULL),
        (16, 'Heading News: Multiple Post Two Colums', 'post-renderer-single-1', 'Heading News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (17, 'National News: Multiple Post Two Rows', 'post-renderer-multiple-2-rows', 'National News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (18, 'National News: Multiple List Post ', 'post-renderer-multiple-list-1', 'National News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (19, 'National News: Multiple List Post With Image ', 'post-renderer-multiple-list-2', 'National News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (20, 'National News: Alert Image', 'image', 'National News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (21, 'With Header: Multiple Post with header', 'post-multiple-with-header', 'With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (22, 'With Header: Slider Post with header', 'post-slider-with-header', 'With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (23, 'Politics With Header: Multiple Post Header First highlights', 'post-renderer-with-header-first-highlight', 'Politics With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (24, 'With Header: Multiple Post Header First highlights Six Colums', 'post-renderer-with-header-first-highlight-6-col', 'With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (25, 'District News: District Name List', 'post-renderer-district-news', 'District News', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (26, 'Google Adsense: Adds', 'google-adds', 'Google Adsense', NULL, '0', NULL, 1, NULL, NULL, NULL),
        (27, 'With Header: Multiple Post Header First highlights Two', 'post-renderer-with-header-first-highlight-2', 'With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (28, 'With Header: Multiple Post Header First highlights Three', 'post-renderer-with-header-first-highlight-3', 'With Header', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (29, 'Gallery: Multiple Image Gallery', 'post-render-gallery', 'Gallery', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (30, 'Category: Category Main Post Right Image', 'post-renderer-category-single-right-image', 'Category', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (31, 'Category: Multiple post list Left Image', 'category-multiple-post-2', 'Category', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (32, 'Category: Multiple post list Latest News', 'post-renderer-category-multiple-last-news', 'Category', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (33, 'Post Details Page: Details Post Multiple Related News', 'post-details-related-news', 'Post Details Page', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (34, 'Post Details Page: Details Post Multiple Latest News', 'post-details-latest-news', 'Post Details Page', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (35, 'Archive: Multiple Archive Post List', 'archive-post-list', 'Archive', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (36, 'Archive: Multiple Latest News List', 'post-renderer-last-news', 'Archive', NULL, '1', NULL, 1, NULL, NULL, NULL),
        (37, 'Marquee', 'marquee', 'marquee', NULL, '0', NULL, 1, NULL, NULL, NULL);

        ");
    }
}
