<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\category;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function managePages()
    {

        $pages = [

            [
                'title' => 'Home Page',
                'route' => route('pages.home'),
                'desc' => 'Manage homepage sections and layouts.',
                'status' => 'Live',
                'icon' => 'fa-solid fa-house',
                'color' => 'primary',
                'tags' => ['Hero', 'Products', 'Reviews']
            ],

            [
                'title' => 'About Page',
                'route' => route('pages.about'),
                'desc' => 'Manage company information and about sections.',
                'status' => 'Live',
                'icon' => 'fa-solid fa-circle-info',
                'color' => 'success',
                'tags' => ['Story', 'Stats']
            ],

            [
                'title' => 'Category Page',
                'route' => route('home.categories.update'),
                'desc' => 'Manage categories and cards.',
                'status' => 'Live',
                'icon' => 'fa-solid fa-layer-group',
                'color' => 'info',
                'tags' => ['Categories', 'Images']
            ],


        ];


        $stats = [

            'total' => count($pages),

            'live' => count($pages),

            'sections' => 25

        ];


        return view(

            'managePage',

            compact(

                'pages',

                'stats'

            )

        );

    }
    private function getPage(): Page
    {
        return Page::firstOrCreate(

            ['slug' => 'home'],

            [
                'page_name' => 'Home Page',
                'content' => []
            ]

        );
    }
    private function getSection(string $section): array
    {
        $page = $this->getPage();

        $content = $page->content ?? [];

        return $content[$section] ?? [];
    }

    private function saveSection(string $section, array $values): void
    {
        $page = $this->getPage();

        $content = $page->content ?? [];


        if (!is_array($content)) {
            $content = [];
        }


        $content[$section] = $values;


        $page->content = $content;

        $page->save();
    }



    public function home()
    {
        $page = $this->getPage();
        $pageData = $page->content ?? [];

        $categories = category::withCount('products')->get();
        $reviews = Review::latest()->get();
        $aiFeatures = [];
        $steps = [];

        $stats = [];

        return view('home', compact(
            'pageData',
            'categories',
            'reviews',
            'aiFeatures',
            'steps',
            'stats'
        ));
    }



    public function updateHero(Request $request)
    {

        $request->validate([
            'hero_badge' => 'nullable|string|max:100',
            'hero_heading' => 'nullable|string|max:200',
            'hero_highlight' => 'nullable|string|max:100',
            'hero_description' => 'nullable|string|max:500',
            'hero_btn_1_text' => 'nullable|string|max:100',
            'hero_btn_1_link' => 'nullable|string|max:200',
            'hero_btn_2_text' => 'nullable|string|max:100',
            'hero_btn_2_link' => 'nullable|string|max:200',
            'hero_stat1_number' => 'nullable|string|max:50',
            'hero_stat1_label' => 'nullable|string|max:100',
            'hero_stat2_number' => 'nullable|string|max:50',
            'hero_stat2_label' => 'nullable|string|max:100',
            'hero_stat3_number' => 'nullable|string|max:50',
            'hero_stat3_label' => 'nullable|string|max:100',
        ]);

        $this->saveSection('hero', [
            'badge' => $request->hero_badge,
            'heading' => $request->hero_heading,
            'highlight' => $request->hero_highlight,
            'subheading' => $request->hero_subheading,
            'description' => $request->hero_description,
            'button1_text' => $request->hero_btn_1_text,
            'button1_link' => $request->hero_btn_1_link,
            'button2_text' => $request->hero_btn_2_text,
            'button2_link' => $request->hero_btn_2_link,
            'stat1_number' => $request->hero_stat1_number,
            'stat1_label' => $request->hero_stat1_label,
            'stat2_number' => $request->hero_stat2_number,
            'stat2_label' => $request->hero_stat2_label,
            'stat3_number' => $request->hero_stat3_number,
            'stat3_label' => $request->hero_stat3_label,
        ]);

        return redirect()->back()->with('success', 'Hero section saved successfully.');
    }




    public function updateBadges(Request $request)
    {

        $badges = [];

        for ($i = 1; $i <= 5; $i++) {

            $badges[] = [

                'icon' => $request->input("badge_{$i}_icon"),

                'heading' => $request->input("badge_{$i}_heading"),

                'subtext' => $request->input("badge_{$i}_subtext"),

            ];
        }

        $this->saveSection('badges', $badges);

        return back()->with('success', 'Badges updated successfully');
    }



    public function updateCategoriesSection(Request $request)
    {
        $request->validate([
            'categories_badge' => 'nullable|string|max:100',
            'categories_heading' => 'nullable|string|max:200',
            'categories_btn_text' => 'nullable|string|max:100',
            'categories_btn_link' => 'nullable|string|max:200',
        ]);

        $this->saveSection('categories_section', [
            'badge' => $request->categories_badge,
            'heading' => $request->categories_heading,
            'btn_text' => $request->categories_btn_text,
            'btn_link' => $request->categories_btn_link,
        ]);

        return redirect()->back()->with('success', 'Category section saved successfully.');
    }



    public function updateFlash(Request $request)
    {
        $request->validate([
            'flash_badge' => 'nullable|string|max:100',
            'flash_heading' => 'nullable|string|max:300',
            'flash_description' => 'nullable|string|max:500',
            'flash_btn_text' => 'nullable|string|max:100',
            'flash_btn_link' => 'nullable|string|max:200',
            'flash_min_discount' => 'nullable|integer|min:1|max:100',
        ]);

        $this->saveSection('flash_sale', [
            'badge' => $request->flash_badge,
            'heading' => $request->flash_heading,
            'description' => $request->flash_description,
            'btn_text' => $request->flash_btn_text,
            'btn_link' => $request->flash_btn_link,
            'min_discount' => $request->flash_min_discount ?? 40,
        ]);

        return redirect()->back()->with('success', 'Flash sale section saved successfully.');
    }




    public function updateAiPicks(Request $request)
    {
        $request->validate([
            'aipicks_badge' => 'nullable|string|max:100',
            'aipicks_heading' => 'nullable|string|max:200',
            'aipicks_description' => 'nullable|string|max:300',
            'aipicks_btn_text' => 'nullable|string|max:100',
            'aipicks_btn_link' => 'nullable|string|max:200',
        ]);

        $this->saveSection('ai_picks', [
            'badge' => $request->aipicks_badge,
            'heading' => $request->aipicks_heading,
            'description' => $request->aipicks_description,
            'btn_text' => $request->aipicks_btn_text,
            'btn_link' => $request->aipicks_btn_link,
        ]);

        return redirect()->back()->with('success', 'AI Picks section saved successfully.');
    }




    public function updateAiFeatures(Request $request)
    {
        $request->validate([
            'aifeatures_heading' => 'nullable|string|max:200',
            'aifeatures_description' => 'nullable|string|max:400',
        ]);

        $this->saveSection('ai_features', [
            'heading' => $request->aifeatures_heading,
            'description' => $request->aifeatures_description,
        ]);

        return redirect()->back()->with('success', 'AI Features section header saved successfully.');
    }




    public function updateReviews(Request $request)
    {
        $request->validate([
            'reviews_badge' => 'nullable|string|max:100',
            'reviews_heading' => 'nullable|string|max:300',
            'reviews_rating' => 'nullable|string|max:10',
            'reviews_rating_sub' => 'nullable|string|max:100',
        ]);

        $this->saveSection('reviews_section', [
            'badge' => $request->reviews_badge,
            'heading' => $request->reviews_heading,
            'rating' => $request->reviews_rating,
            'rating_sub' => $request->reviews_rating_sub,
        ]);

        return redirect()->back()->with('success', 'Reviews section saved successfully.');
    }



    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_badge' => 'nullable|string|max:100',
            'about_heading' => 'nullable|string|max:300',
            'about_para1' => 'nullable|string|max:1000',
            'about_para2' => 'nullable|string|max:1000',
            'about_panel_title' => 'nullable|string|max:200',
            'about_panel_subtitle' => 'nullable|string|max:200',
            'about_bullets' => 'nullable|string|max:2000',
            'about_stat1_number' => 'nullable|string|max:50',
            'about_stat1_label' => 'nullable|string|max:100',
            'about_stat2_number' => 'nullable|string|max:50',
            'about_stat2_label' => 'nullable|string|max:100',
            'about_stat3_number' => 'nullable|string|max:50',
            'about_stat3_label' => 'nullable|string|max:100',
            'about_btn1_text' => 'nullable|string|max:100',
            'about_btn1_link' => 'nullable|string|max:200',
            'about_btn2_text' => 'nullable|string|max:100',
            'about_btn2_link' => 'nullable|string|max:200',
        ]);


        $bulletsRaw = $request->about_bullets ?? '';
        $bullets = array_values(array_filter(
            array_map('trim', explode("\n", $bulletsRaw))
        ));

        $this->saveSection('about', [
            'badge' => $request->about_badge,
            'heading' => $request->about_heading,
            'para1' => $request->about_para1,
            'para2' => $request->about_para2,
            'panel_title' => $request->about_panel_title,
            'panel_subtitle' => $request->about_panel_subtitle,
            'bullets' => $bulletsRaw,
            'bullets_array' => $bullets,
            'stat1_number' => $request->about_stat1_number,
            'stat1_label' => $request->about_stat1_label,
            'stat2_number' => $request->about_stat2_number,
            'stat2_label' => $request->about_stat2_label,
            'stat3_number' => $request->about_stat3_number,
            'stat3_label' => $request->about_stat3_label,
            'btn1_text' => $request->about_btn1_text,
            'btn1_link' => $request->about_btn1_link,
            'btn2_text' => $request->about_btn2_text,
            'btn2_link' => $request->about_btn2_link,
        ]);

        return redirect()->back()->with('success', 'About section saved successfully.');
    }




    public function updateHowItWorks(Request $request)
    {
        $request->validate([
            'hiw_badge' => 'nullable|string|max:100',
            'hiw_heading' => 'nullable|string|max:200',
            'hiw_subheading' => 'nullable|string|max:300',
            'hiw_btn_text' => 'nullable|string|max:100',
            'hiw_btn_link' => 'nullable|string|max:200',
        ]);

        $this->saveSection('how_it_works', [
            'badge' => $request->hiw_badge,
            'heading' => $request->hiw_heading,
            'subheading' => $request->hiw_subheading,
            'btn_text' => $request->hiw_btn_text,
            'btn_link' => $request->hiw_btn_link,
        ]);

        return redirect()->back()->with('success', 'How It Works section saved successfully.');
    }



    public function updateNewsletter(Request $request)
    {
        $request->validate([
            'newsletter_badge' => 'nullable|string|max:100',
            'newsletter_heading' => 'nullable|string|max:300',
            'newsletter_subheading' => 'nullable|string|max:400',
            'newsletter_placeholder' => 'nullable|string|max:100',
            'newsletter_btn_text' => 'nullable|string|max:100',
        ]);

        $this->saveSection('newsletter', [
            'badge' => $request->newsletter_badge,
            'heading' => $request->newsletter_heading,
            'subheading' => $request->newsletter_subheading,
            'placeholder' => $request->newsletter_placeholder,
            'btn_text' => $request->newsletter_btn_text,
        ]);

        return redirect()->back()->with('success', 'Newsletter section saved successfully.');
    }

public function homeApi()
{
    return response()->json([
        "message" => "API Working"
    ]);
}
}

