<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class CssController extends Controller
{
    public function commoncss()
    {
        // Get dynamic values from settings
        $colorHex = __settings('color') ?? '06bc76';


        // Ensure # prefix
        if (!str_starts_with($colorHex, '#')) {
            $colorHex = '#' . $colorHex;
        }


        $hsl = $this->hexToHsl($colorHex);
        $theme = __settings('theme') ?? 'light'; // 'light' or 'dark'

        $css = $this->generateThemeVariables($hsl);
        $css .= $this->generateUtilityClasses();

        return response($css, 200)
            ->header('Content-Type', 'text/css; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    private function generateThemeVariables(array $hsl): string
    {
        $h = $hsl['h'];
        $s = $hsl['s'];
        $l = $hsl['l'];

        // Adjust primary color for dark mode if it's too dark
        // If lightness is less than 40%, we boost it to 50% for better visibility on dark backgrounds
        $darkL = $l < 40 ? 50 : $l;
        // Also ensure saturation isn't too low for dark mode primary
        $darkS = $s < 30 ? 40 : $s;

        return <<<CSS
:root {
    /* LIGHT MODE VARIABLES */
    --primary: hsl({$h} {$s}% {$l}%) !important;
    --primary-foreground: 0 0% 100% !important;
    
    /* Primary Opacity Variations */
    --primary-10: hsl({$h} {$s}% {$l}% / 0.1) !important;
    --primary-20: hsl({$h} {$s}% {$l}% / 0.2) !important;
    --primary-30: hsl({$h} {$s}% {$l}% / 0.3) !important;
    --primary-40: hsl({$h} {$s}% {$l}% / 0.4) !important;
    --primary-50: hsl({$h} {$s}% {$l}% / 0.5) !important;
    --primary-80: hsl({$h} {$s}% {$l}% / 0.8) !important;
    
    /* Legacy variables */
    --theme-color: hsl({$h}, {$s}%, {$l}%) !important;
    --activeColor: hsl({$h}, {$s}%, {$l}%) !important;
    --primaryColor: hsl({$h}, {$s}%, {$l}%) !important;
    
    /* Secondary/Accent */
    --secondary: {$h} 30% 96% !important;
    --secondary-foreground: {$h} 10% 10% !important;
    --accent: {$h} 30% 96% !important;
    --accent-foreground: {$h} 10% 10% !important;
    
    /* Muted */
    --muted: 0 0% 96% !important;
    --muted-foreground: 0 0% 45% !important;
    
    /* Background & Foreground */
    --background: 0 0% 100% !important;
    --foreground: 0 0% 3.9% !important;
    
    /* Card */
    --card: 0 0% 100% !important;
    --card-foreground: 0 0% 3.9% !important;
    
    /* Popover */
    --popover: 0 0% 100% !important;
    --popover-foreground: 0 0% 3.9% !important;
    
    /* Border & Input */
    --border: 0 0% 89.8% !important;
    --input: 0 0% 89.8% !important;
    --ring: {$h} {$s}% {$l}% !important;
    
    /* Radius */
    --radius: 0.5rem !important;
    
    /* Status Colors */
    --destructive: 0 84.2% 60.2% !important;
    --destructive-foreground: 0 0% 98% !important;
    --success: 142 76% 36% !important;
    --success-foreground: 0 0% 98% !important;
    --warning: 38 92% 50% !important;
    --warning-foreground: 0 0% 98% !important;
    --info: 199 89% 48% !important;
    --info-foreground: 0 0% 98% !important;
    
    /* Status Opacity Variations */
    --destructive-10: hsl(0 84.2% 60.2% / 0.1) !important;
    --destructive-20: hsl(0 84.2% 60.2% / 0.2) !important;
    --destructive-50: hsl(0 84.2% 60.2% / 0.5) !important;
    
    --danger-10: var(--destructive-10) !important;
    --danger-20: var(--destructive-20) !important;
    --danger-50: var(--destructive-50) !important;
    
    --success-10: hsl(142 76% 36% / 0.1) !important;
    --success-20: hsl(142 76% 36% / 0.2) !important;
    --success-50: hsl(142 76% 36% / 0.5) !important;
    
    --warning-10: hsl(38 92% 50% / 0.1) !important;
    --warning-20: hsl(38 92% 50% / 0.2) !important;
    --warning-50: hsl(38 92% 50% / 0.5) !important;
    
    --info-10: hsl(199 89% 48% / 0.1) !important;
    --info-20: hsl(199 89% 48% / 0.2) !important;
    --info-50: hsl(199 89% 48% / 0.5) !important;
    
    /* Legacy AdminLTE Light Mode */
    --border-color: #eee !important;
    --background-color: #f1f5f6 !important;
    --body-color-bg: #f6f4f4 !important;
    --color: #343a40 !important;
    --primary-bg: rgb(229 234 242) !important;
    --soft-background: rgb(97 80 80 / 10%) !important;
    --nav-color: #f8f9fa !important;
    --box-shadow: #eee !important;
    --input-color: #eee !important;
    --card-background: #fff !important;
    --soft-border-color: #eee !important;
    --white-color: #fff !important;
}

/* DARK MODE VARIABLES */
.dark, .theme-dark {
    /* Primary (Adjusted for visibility) */
    --primary: hsl({$h} {$darkS}% {$darkL}%) !important;
    --primary-foreground: 0 0% 100% !important;
    
    /* Primary Opacity Variations */
    --primary-10: hsl({$h} {$darkS}% {$darkL}% / 0.1) !important;
    --primary-20: hsl({$h} {$darkS}% {$darkL}% / 0.2) !important;
    --primary-30: hsl({$h} {$darkS}% {$darkL}% / 0.3) !important;
    --primary-40: hsl({$h} {$darkS}% {$darkL}% / 0.4) !important;
    --primary-50: hsl({$h} {$darkS}% {$darkL}% / 0.5) !important;
    --primary-80: hsl({$h} {$darkS}% {$darkL}% / 0.8) !important;
    
    /* Legacy */
    --theme-color: hsl({$h}, {$darkS}%, {$darkL}%) !important;
    --activeColor: hsl({$h}, {$darkS}%, {$darkL}%) !important;
    --primaryColor: hsl({$h}, {$darkS}%, {$darkL}%) !important;
    --active-color: hsl({$h}, {$darkS}%, {$darkL}%) !important;
    
    /* Secondary/Accent */
    --secondary: {$h} 20% 14% !important;
    --secondary-foreground: 0 0% 98% !important;
    --accent: {$h} 20% 14% !important;
    --accent-foreground: 0 0% 98% !important;
    
    /* Muted */
    --muted: 0 0% 14.9% !important;
    --muted-foreground: 0 0% 63.9% !important;
    
    /* Background & Foreground (User Preferred) */
    --background: 222 47% 10% !important;
    --foreground: 210 14% 83% !important;
    
    /* Card */
    --card: 222 47% 10% !important;
    --card-foreground: 210 14% 83% !important;
    
    /* Popover */
    --popover: 222 47% 10% !important;
    --popover-foreground: 210 14% 83% !important;
    
    /* Border & Input */
    --border: 216 12% 84% !important;
    --input: 210 10% 23% !important;
    --ring: {$h} {$darkS}% {$darkL}% !important;
    
    /* Status Colors */
    --destructive: 0 62.8% 30.6% !important;
    --destructive-foreground: 0 0% 98% !important;
    
    /* Status Opacity Variations (Dark Mode) */
    --destructive-10: hsl(0 62.8% 30.6% / 0.1) !important;
    --destructive-20: hsl(0 62.8% 30.6% / 0.2) !important;
    --destructive-50: hsl(0 62.8% 30.6% / 0.5) !important;
    
    --danger-10: var(--destructive-10) !important;
    --danger-20: var(--destructive-20) !important;
    --danger-50: var(--destructive-50) !important;
    
    /* Success/Warning/Info usually stay same hue in dark mode, but opacity applies to that hue */
    --success-10: hsl(142 76% 36% / 0.1) !important;
    --success-20: hsl(142 76% 36% / 0.2) !important;
    --success-50: hsl(142 76% 36% / 0.5) !important;
    
    --warning-10: hsl(38 92% 50% / 0.1) !important;
    --warning-20: hsl(38 92% 50% / 0.2) !important;
    --warning-50: hsl(38 92% 50% / 0.5) !important;
    
    --info-10: hsl(199 89% 48% / 0.1) !important;
    --info-20: hsl(199 89% 48% / 0.2) !important;
    --info-50: hsl(199 89% 48% / 0.5) !important;
    
    /* Legacy AdminLTE Dark Mode (User Preferred) */
    --border-color: rgba(209, 213, 219, 0.1) !important;
    --background-color: rgb(14, 23, 39) !important;
    --color: #c2c7d0 !important;
    --body-color-bg: rgb(14, 23, 39) !important;
    --primary-bg: rgb(52, 58, 64) !important;
    --soft-background: rgba(255, 255, 255, 0.1) !important;
    --card-background: rgba(255, 255, 255, 0.1) !important;
    --box-shadow: rgba(0, 0, 0, 0.1) !important;
    --nav-color: rgb(14, 23, 39) !important;
    --input-color: rgb(14, 23, 39) !important;
    --soft-border-color: #555 !important;
    --sideNavbar-background: #343a40 !important;
    --sideNavbar-border: #4b545c !important;
    --sideNavbar-text: #c2c7d0 !important;

    .card .card-header .card-title, .card .card-header .h5{
        color: var(--color) !important;
    }
} 

/* LIGHT MODE OVERRIDES */
.light, .theme-light {
    /* Same as :root */
    --primary: hsl({$h} {$s}% {$l}%) !important;
    --primary-foreground: 0 0% 100% !important;
    --theme-color: hsl({$h}, {$s}%, {$l}%) !important;
    --activeColor: hsl({$h}, {$s}%, {$l}%) !important;
    --primaryColor: hsl({$h}, {$s}%, {$l}%) !important;
    --background: 0 0% 100% !important;
    --foreground: 0 0% 3.9% !important;
    --card: 0 0% 100% !important;
    --card-foreground: 0 0% 3.9% !important;
    --border: 0 0% 89.8% !important;
    --input: 0 0% 89.8% !important;
    
    /* Legacy AdminLTE Light Mode */
    --border-color: #eee !important;
    --background-color: #f1f5f6 !important;
    --body-color-bg: #f6f4f4 !important;
    --color: #343a40 !important;
    --primary-bg: rgb(229 234 242) !important;
    --soft-background: rgb(97 80 80 / 10%) !important;
    --nav-color: #f8f9fa !important;
    --box-shadow: #eee !important;
    --input-color: #eee !important;
    --card-background: #fff !important;
    --soft-border-color: #eee !important;
}

/* Utility classes */
.bg-primary { background-color: var(--primary) !important; }
.bg-primary-10 { background-color: var(--primary-10) !important; }
.bg-primary-20 { background-color: var(--primary-20) !important; }
.bg-primary-30 { background-color: var(--primary-30) !important; }
.bg-primary-40 { background-color: var(--primary-40) !important; }
.bg-primary-50 { background-color: var(--primary-50) !important; }
.bg-primary-80 { background-color: var(--primary-80) !important; }

.bg-secondary { background-color: hsl(var(--secondary)) !important; }
.bg-secondary-10 { background-color: hsl(var(--secondary) / 0.1) !important; }
.bg-secondary-20 { background-color: hsl(var(--secondary) / 0.2) !important; }
.bg-secondary-50 { background-color: hsl(var(--secondary) / 0.5) !important; }

.bg-accent { background-color: hsl(var(--accent)) !important; }
.bg-accent-10 { background-color: hsl(var(--accent) / 0.1) !important; }
.bg-accent-20 { background-color: hsl(var(--accent) / 0.2) !important; }

.bg-muted { background-color: hsl(var(--muted)) !important; }

.bg-card { background-color: hsl(var(--card)) !important; }
.bg-popover { background-color: hsl(var(--popover)) !important; }

/* Destructive / Danger */
.bg-destructive { background-color: hsl(var(--destructive)) !important; }
.bg-destructive-10 { background-color: var(--destructive-10) !important; }
.bg-destructive-20 { background-color: var(--destructive-20) !important; }
.bg-destructive-50 { background-color: var(--destructive-50) !important; }

.bg-danger { background-color: hsl(var(--destructive)) !important; }
.bg-danger-10 { background-color: var(--danger-10) !important; }
.bg-danger-20 { background-color: var(--danger-20) !important; }
.bg-danger-50 { background-color: var(--danger-50) !important; }

/* Success */
.bg-success { background-color: hsl(var(--success)) !important; }
.bg-success-10 { background-color: var(--success-10) !important; }
.bg-success-20 { background-color: var(--success-20) !important; }
.bg-success-50 { background-color: var(--success-50) !important; }

/* Warning */
.bg-warning { background-color: hsl(var(--warning)) !important; }
.bg-warning-10 { background-color: var(--warning-10) !important; }
.bg-warning-20 { background-color: var(--warning-20) !important; }
.bg-warning-50 { background-color: var(--warning-50) !important; }

/* Info */
.bg-info { background-color: hsl(var(--info)) !important; }
.bg-info-10 { background-color: var(--info-10) !important; }
.bg-info-20 { background-color: var(--info-20) !important; }
.bg-info-50 { background-color: var(--info-50) !important; }

/* Text Colors */
.text-primary { color: hsl(var(--primary)) !important; }
.text-primary-10, .primary-10 { color: var(--primary-10) !important; }
.text-primary-20, .primary-20 { color: var(--primary-20) !important; }
.text-primary-30, .primary-30 { color: var(--primary-30) !important; }
.text-primary-40, .primary-40 { color: var(--primary-40) !important; }
.text-primary-50, .primary-50 { color: var(--primary-50) !important; }
.text-primary-80, .primary-80 { color: var(--primary-80) !important; }

.text-secondary { color: hsl(var(--secondary-foreground)) !important; }
.text-secondary-10, .secondary-10 { color: hsl(var(--secondary-foreground) / 0.1) !important; }
.text-secondary-20, .secondary-20 { color: hsl(var(--secondary-foreground) / 0.2) !important; }
.text-secondary-50, .secondary-50 { color: hsl(var(--secondary-foreground) / 0.5) !important; }

.text-muted { color: hsl(var(--muted-foreground)) !important; }
.text-foreground { color: hsl(var(--foreground)) !important; }
.text-destructive { color: hsl(var(--destructive)) !important; }
.text-destructive-10, .destructive-10 { color: var(--destructive-10) !important; }
.text-destructive-20, .destructive-20 { color: var(--destructive-20) !important; }
.text-destructive-50, .destructive-50 { color: var(--destructive-50) !important; }

.text-danger { color: hsl(var(--destructive)) !important; }
.text-danger-10, .danger-10 { color: var(--danger-10) !important; }
.text-danger-20, .danger-20 { color: var(--danger-20) !important; }
.text-danger-50, .danger-50 { color: var(--danger-50) !important; }

.text-success { color: hsl(var(--success)) !important; }
.text-success-10, .success-10 { color: var(--success-10) !important; }
.text-success-20, .success-20 { color: var(--success-20) !important; }
.text-success-50, .success-50 { color: var(--success-50) !important; }

.text-warning { color: hsl(var(--warning)) !important; }
.text-warning-10, .warning-10 { color: var(--warning-10) !important; }
.text-warning-20, .warning-20 { color: var(--warning-20) !important; }
.text-warning-50, .warning-50 { color: var(--warning-50) !important; }

.text-info { color: hsl(var(--info)) !important; }
.text-info-10, .info-10 { color: var(--info-10) !important; }
.text-info-20, .info-20 { color: var(--info-20) !important; }
.text-info-50, .info-50 { color: var(--info-50) !important; }

/* Border Colors */
.border-primary { border-color: hsl(var(--primary)) !important; }
.border-border { border-color: hsl(var(--border)) !important; }
.border-input { border-color: hsl(var(--input)) !important; }
.border-danger { border-color: hsl(var(--destructive)) !important; }
.border-success { border-color: hsl(var(--success)) !important; }
.border-warning { border-color: hsl(var(--warning)) !important; }
.border-info { border-color: hsl(var(--info)) !important; }

/* Flexbox utilities */
.flex { display: flex; }
.flex-row { flex-direction: row !important; }
.flex-column { flex-direction: column !important; }
.flex-row-reverse { flex-direction: row-reverse !important; }
.space-between { display: flex; justify-content: space-between !important; }
.space-around { display: flex; justify-content: space-around !important; }
.align-center { display: flex; align-items: center !important; }
.flex-1 { flex: 1; }
.flex-0 { flex: 0; }

.centerCard {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 65dvh;
}

/* AJAX LOADING OVERLAY */
.loading-overlay {
    position: relative;
    min-height: 200px;
}

.loading-overlay::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(2px);
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius);
    transition: all 0.3s ease;
}

.dark .loading-overlay::after {
    background: rgba(14, 23, 39, 0.6);
}

.loading-overlay::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin-top: -20px;
    margin-left: -20px;
    border: 3px solid var(--primary-20);
    border-top-color: var(--primary);
    border-radius: 50%;
    z-index: 1000;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.ajax-content-fade {
    animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

CSS;
    }

    private function generateUtilityClasses(): string
    {
        $css = '';

        // Generate spacing utilities (0-100)
        for ($i = 0; $i < 100; $i++) {
            $css .= ".pt-{$i} { padding-top: {$i}px !important; }\n";
            $css .= ".pb-{$i} { padding-bottom: {$i}px !important; }\n";
            $css .= ".pt-{$i}rm { padding-top: {$i}rem !important; }\n";
            $css .= ".pb-{$i}rm { padding-bottom: {$i}rem !important; }\n";
            $css .= ".pl-{$i} { padding-left: {$i}px !important; }\n";
            $css .= ".pr-{$i} { padding-right: {$i}px !important; }\n";
            $css .= ".mt-{$i} { margin-top: {$i}px !important; }\n";
            $css .= ".mb-{$i} { margin-bottom: {$i}px !important; }\n";
            $css .= ".mt-{$i}rm { margin-top: {$i}rem !important; }\n";
            $css .= ".mb-{$i}rm { margin-bottom: {$i}rem !important; }\n";
            $css .= ".ml-{$i} { margin-left: {$i}px !important; }\n";
            $css .= ".mr-{$i} { margin-right: {$i}px !important; }\n";
            $css .= ".p-{$i} { padding: {$i}px !important; }\n";
            $css .= ".m-{$i} { margin: {$i}px !important; }\n";
            $css .= ".my-{$i}rm { margin-top: {$i}rem !important; margin-bottom: {$i}rem !important; }\n";
            $css .= ".mx-{$i}rm { margin-left: {$i}rem !important; margin-right: {$i}rem !important; }\n";
            $css .= ".py-{$i} { padding-top: {$i}px !important; padding-bottom: {$i}px !important; }\n";
            $css .= ".px-{$i} { padding-left: {$i}px !important; padding-right: {$i}px !important; }\n";
            $css .= ".py-{$i}rm { padding-top: {$i}rem !important; padding-bottom: {$i}rem !important; }\n";
            $css .= ".px-{$i}rm { padding-left: {$i}rem !important; padding-right: {$i}rem !important; }\n";
            $css .= ".p-{$i}rm { padding: {$i}rem !important; }\n";
            $css .= ".gap-{$i} { gap: {$i}px !important; }\n";
            $css .= ".gap-{$i}rm { gap: {$i}rem !important; }\n";
            $css .= ".fz-{$i} { font-size: {$i}px !important; }\n";
            $css .= ".fz-{$i}rm { font-size: {$i}rem !important; }\n";
            $css .= ".ht-{$i} { height: {$i}px !important; }\n";
            $css .= ".bb-solid-{$i} { border-bottom: 1px solid; }\n";
            $css .= ".bt-solid-{$i} { border-top: 1px solid; }\n";
            $css .= ".bt-dashed-{$i} { border-top: 1px dashed; }\n";
            $css .= ".bb-dashed-{$i} { border-bottom: 1px dashed; }\n";
        }

        // Width/height utilities (0-500)
        for ($i = 0; $i < 500; $i++) {
            $css .= ".wd-{$i} { width: {$i}px !important; }\n";
            $css .= ".wd-{$i}rm { width: {$i}rem !important; }\n";
            $css .= ".ht-{$i}rm { height: {$i}rem !important; }\n";
            $css .= ".min-w-{$i} { min-width: {$i}px !important; }\n";
            $css .= ".max-w-{$i} { max-width: {$i}px !important; }\n";
            $css .= ".min-w-{$i}rm { min-width: {$i}rem !important; }\n";
            $css .= ".max-w-{$i}rm { max-width: {$i}rem !important; }\n";
        }

        return $css;
    }

    private function hexToHsl($hex): array
    {
        // Remove # if present
        $hex = ltrim($hex, '#');

        // Convert hex to RGB
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max == $min) {
            $h = $s = 0;
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

            // Use epsilon comparison for floats
            if (abs($max - $r) < 0.00001) {
                $h = (($g - $b) / $d + ($g < $b ? 6 : 0)) / 6;
            } elseif (abs($max - $g) < 0.00001) {
                $h = (($b - $r) / $d + 2) / 6;
            } else {
                $h = (($r - $g) / $d + 4) / 6;
            }
        }

        return [
            'h' => round($h * 360),
            's' => round($s * 100),
            'l' => round($l * 100)
        ];
    }
}
