<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{

    private function getPage(): Page
    {
        return Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'page_name' => 'About Page',
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


    public function manage()
    {
        $page = $this->getPage();
        $pageData = $page->content ?? [];

        return view('about', compact('pageData'));
    }


    public function show() 
    {
        $page = $this->getPage();
        $pageData = $page->content ?? [];

        return view('about', compact('pageData'));
    }

       public function aboutApi()
    {
        $page = Page::where('slug', 'about')->first();

        return response()->json([
            'success' => true,
            'data' => $page->content ?? [],
        ]);
    }


    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_badge' => 'nullable|string|max:100',
            'hero_heading' => 'nullable|string|max:200',
            'hero_highlight' => 'nullable|string|max:100',
            'hero_description' => 'nullable|string|max:500',
            'hero_btn1_text' => 'nullable|string|max:100',
            'hero_btn1_link' => 'nullable|string|max:200',
            'hero_btn2_text' => 'nullable|string|max:100',
            'hero_btn2_link' => 'nullable|string|max:200',
        ]);

        $this->saveSection('hero', [
            'badge' => $request->hero_badge,
            'heading' => $request->hero_heading,
            'highlight' => $request->hero_highlight,
            'description' => $request->hero_description,
            'btn1_text' => $request->hero_btn1_text,
            'btn1_link' => $request->hero_btn1_link,
            'btn2_text' => $request->hero_btn2_text,
            'btn2_link' => $request->hero_btn2_link,
        ]);

        return redirect()->back()->with('success', 'Hero section saved successfully.');
    }

    
    public function updateStats(Request $request)
    {
        $stats = [];
        for ($i = 1; $i <= 4; $i++) {
            $stats[] = [
                'icon' => $request->input("stat_{$i}_icon"),
                'number' => $request->input("stat_{$i}_number"),
                'label' => $request->input("stat_{$i}_label"),
            ];
        }

        $this->saveSection('stats', $stats);

        return redirect()->back()->with('success', 'Stats bar saved successfully.');
    }

   
    public function updateStory(Request $request)
    {
        $request->validate([
            'story_badge' => 'nullable|string|max:100',
            'story_heading' => 'nullable|string|max:300',
            'story_para1' => 'nullable|string|max:1000',
            'story_para2' => 'nullable|string|max:1000',
            'story_highlight' => 'nullable|string|max:300',
            'story_panel_title' => 'nullable|string|max:200',
            'story_panel_subtitle' => 'nullable|string|max:200',
            'story_bullets' => 'nullable|string|max:2000',
            'story_trust_label' => 'nullable|string|max:200',
        ]);

        $bulletsRaw = $request->story_bullets ?? '';
        $bulletsArray = array_values(array_filter(
            array_map('trim', explode("\n", $bulletsRaw))
        ));

        $this->saveSection('story', [
            'badge' => $request->story_badge,
            'heading' => $request->story_heading,
            'para1' => $request->story_para1,
            'para2' => $request->story_para2,
            'highlight' => $request->story_highlight,
            'panel_title' => $request->story_panel_title,
            'panel_subtitle' => $request->story_panel_subtitle,
            'bullets' => $bulletsRaw,
            'bullets_array' => $bulletsArray,
            'trust_label' => $request->story_trust_label,
        ]);

        return redirect()->back()->with('success', 'Our Story section saved successfully.');
    }

 
    public function updateValues(Request $request)
    {
        $request->validate([
            'values_badge' => 'nullable|string|max:100',
            'values_heading' => 'nullable|string|max:200',
            'values_description' => 'nullable|string|max:400',
        ]);

        
        $cards = [];
        for ($i = 1; $i <= 6; $i++) {
            if ($request->input("value_{$i}_title")) {
                $cards[] = [
                    'icon' => $request->input("value_{$i}_icon"),
                    'title' => $request->input("value_{$i}_title"),
                    'description' => $request->input("value_{$i}_description"),
                ];
            }
        }

        $this->saveSection('values', [
            'badge' => $request->values_badge,
            'heading' => $request->values_heading,
            'description' => $request->values_description,
            'cards' => $cards,
        ]);

        return redirect()->back()->with('success', 'Core Values section saved successfully.');
    }

  
    public function updateTimeline(Request $request)
    {
        $request->validate([
            'timeline_badge' => 'nullable|string|max:100',
            'timeline_heading' => 'nullable|string|max:200',
        ]);

        
        $milestones = [];
        for ($i = 1; $i <= 6; $i++) {
            if ($request->input("milestone_{$i}_year")) {
                $milestones[] = [
                    'year' => $request->input("milestone_{$i}_year"),
                    'title' => $request->input("milestone_{$i}_title"),
                    'description' => $request->input("milestone_{$i}_description"),
                ];
            }
        }

        $this->saveSection('timeline', [
            'badge' => $request->timeline_badge,
            'heading' => $request->timeline_heading,
            'milestones' => $milestones,
        ]);

        return redirect()->back()->with('success', 'Timeline section saved successfully.');
    }

    
    public function updateTeam(Request $request)
    {
        $request->validate([
            'team_badge' => 'nullable|string|max:100',
            'team_heading' => 'nullable|string|max:200',
            'team_description' => 'nullable|string|max:400',
        ]);

        
        $members = [];
        for ($i = 1; $i <= 6; $i++) {
            if ($request->input("member_{$i}_name")) {
                $members[] = [
                    'name' => $request->input("member_{$i}_name"),
                    'role' => $request->input("member_{$i}_role"),
                    'location' => $request->input("member_{$i}_location"),
                    'linkedin' => $request->input("member_{$i}_linkedin"),
                    'twitter' => $request->input("member_{$i}_twitter"),
                ];
            }
        }

        $this->saveSection('team', [
            'badge' => $request->team_badge,
            'heading' => $request->team_heading,
            'description' => $request->team_description,
            'members' => $members,
        ]);

        return redirect()->back()->with('success', 'Team section saved successfully.');
    }

  
    public function updateAwards(Request $request)
    {
        $request->validate([
            'awards_badge' => 'nullable|string|max:100',
            'awards_heading' => 'nullable|string|max:200',
        ]);

        $awards = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->input("award_{$i}_title")) {
                $awards[] = [
                    'icon' => $request->input("award_{$i}_icon"),
                    'title' => $request->input("award_{$i}_title"),
                    'subtitle' => $request->input("award_{$i}_subtitle"),
                ];
            }
        }

        $this->saveSection('awards', [
            'badge' => $request->awards_badge,
            'heading' => $request->awards_heading,
            'items' => $awards,
        ]);

        return redirect()->back()->with('success', 'Awards section saved successfully.');
    }

   
    public function updateCta(Request $request)
    {
        $request->validate([
            'cta_badge' => 'nullable|string|max:100',
            'cta_heading' => 'nullable|string|max:200',
            'cta_description' => 'nullable|string|max:400',
            'cta_btn1_text' => 'nullable|string|max:100',
            'cta_btn1_link' => 'nullable|string|max:200',
            'cta_btn2_text' => 'nullable|string|max:100',
            'cta_btn2_link' => 'nullable|string|max:200',
        ]);

        $this->saveSection('cta', [
            'badge' => $request->cta_badge,
            'heading' => $request->cta_heading,
            'description' => $request->cta_description,
            'btn1_text' => $request->cta_btn1_text,
            'btn1_link' => $request->cta_btn1_link,
            'btn2_text' => $request->cta_btn2_text,
            'btn2_link' => $request->cta_btn2_link,
        ]);

        return redirect()->back()->with('success', 'CTA section saved successfully.');
    }
}