<?php

namespace Modules\UserMessenger\Mail;

use Illuminate\Mail\Mailable as LaravelMailable;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Mailable extends LaravelMailable
{
    /**
     * The list of default styles.
     *
     * @var array
     */
    protected $defaultStyles = [
        'assets/canvas/css/bootstrap.css',
        'build/css/site.theme.min.css',
    ];

    /**
     * Inject styles into HTML.
     *
     * @param string $html
     * @param array $styles
     *
     * @return string
     */
    public function injectStyles(string $html, array $styles = [])
    {
        $css = '';

        foreach (array_merge($this->defaultStyles, $styles) as $file)
        {
            $path = public_path($file);

            if (file_exists($path)) {
                $css .= file_get_contents($path);
            }
        }

        return (new CssToInlineStyles)->convert($html, $css);
    }
}
