<?php
/**
 * Design Tokens Generator
 * Генерує CSS змінні з design_system.json
 */

function pf_generate_css_variables()
{
    $json_path = get_template_directory() . '/design_system.json';

    if (!file_exists($json_path)) {
        return '';
    }

    $json = file_get_contents($json_path);
    $ds = json_decode($json, true);

    if (!$ds) {
        return '';
    }

    $css = ":root {\n";

    // Colors - Primary
    if (isset($ds['colors']['primary'])) {
        $css .= "  /* Primary Colors */\n";
        $css .= "  --color-primary: {$ds['colors']['primary']['main']};\n";
        $css .= "  --color-primary-light: {$ds['colors']['primary']['light']};\n";
        $css .= "  --color-primary-dark: {$ds['colors']['primary']['dark']};\n";
        if (isset($ds['colors']['primary']['glow'])) {
            $css .= "  --color-primary-glow: {$ds['colors']['primary']['glow']};\n";
        }
    }

    // Colors - Secondary
    if (isset($ds['colors']['secondary'])) {
        $css .= "\n  /* Secondary Colors */\n";
        foreach ($ds['colors']['secondary'] as $name => $value) {
            $css .= "  --color-secondary-{$name}: {$value};\n";
        }
    }

    // Colors - Background
    if (isset($ds['colors']['background'])) {
        $css .= "\n  /* Background Colors */\n";
        foreach ($ds['colors']['background'] as $name => $value) {
            $css .= "  --bg-{$name}: {$value};\n";
        }
    }

    // Colors - Text
    if (isset($ds['colors']['text'])) {
        $css .= "\n  /* Text Colors */\n";
        foreach ($ds['colors']['text'] as $name => $value) {
            $css .= "  --text-{$name}: {$value};\n";
        }
    }

    // Colors - Border
    if (isset($ds['colors']['border'])) {
        $css .= "\n  /* Border Colors */\n";
        foreach ($ds['colors']['border'] as $name => $value) {
            $css .= "  --border-{$name}: {$value};\n";
        }
    }

    // Gradients
    if (isset($ds['gradients'])) {
        $css .= "\n  /* Gradients */\n";
        foreach ($ds['gradients'] as $name => $gradient) {
            $type = $gradient['type'] ?? 'linear';
            if ($type === 'radial' && isset($gradient['stops'])) {
                $stops = implode(', ', $gradient['stops']);
                $css .= "  --gradient-{$name}: radial-gradient({$stops});\n";
            } elseif (isset($gradient['stops'])) {
                $stops = implode(', ', $gradient['stops']);
                $css .= "  --gradient-{$name}: linear-gradient({$gradient['direction']}, {$stops});\n";
            }
        }
    }

    // Effects
    if (isset($ds['effects'])) {
        $css .= "\n  /* Effects */\n";
        foreach ($ds['effects'] as $effect_name => $props) {
            foreach ($props as $prop_name => $value) {
                // Convert camelCase to kebab-case
                $kebab_name = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $prop_name));
                $css .= "  --{$effect_name}-{$kebab_name}: {$value};\n";
            }
        }
    }

    // Typography - Font Family
    if (isset($ds['typography']['fontFamily'])) {
        $css .= "\n  /* Font Families */\n";
        foreach ($ds['typography']['fontFamily'] as $name => $value) {
            $css .= "  --font-{$name}: {$value};\n";
        }
    }

    // Typography - Font Size
    if (isset($ds['typography']['fontSize'])) {
        $css .= "\n  /* Font Sizes */\n";
        foreach ($ds['typography']['fontSize'] as $size => $value) {
            $css .= "  --font-size-{$size}: {$value};\n";
        }
    }

    // Typography - Font Weight
    if (isset($ds['typography']['fontWeight'])) {
        $css .= "\n  /* Font Weights */\n";
        foreach ($ds['typography']['fontWeight'] as $weight => $value) {
            $css .= "  --font-weight-{$weight}: {$value};\n";
        }
    }

    // Spacing
    if (isset($ds['spacing'])) {
        $css .= "\n  /* Spacing */\n";
        foreach ($ds['spacing'] as $size => $value) {
            $css .= "  --space-{$size}: {$value};\n";
        }
    }

    // Border Radius
    if (isset($ds['borderRadius'])) {
        $css .= "\n  /* Border Radius */\n";
        foreach ($ds['borderRadius'] as $size => $value) {
            $css .= "  --radius-{$size}: {$value};\n";
        }
    }

    // Shadows
    if (isset($ds['shadows'])) {
        $css .= "\n  /* Shadows */\n";
        foreach ($ds['shadows'] as $name => $value) {
            $css .= "  --shadow-{$name}: {$value};\n";
        }
    }

    $css .= "}\n";

    return $css;
}

// Виводимо CSS змінні в <head>
function pf_output_css_variables()
{
    $css = pf_generate_css_variables();
    if ($css) {
        echo '<style id="design-tokens">' . $css . '</style>';
    }
}
add_action('wp_head', 'pf_output_css_variables', 1);
