<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/08/2017
 * Time: 10:38 AM
 */

namespace Modules\Mailmessenger\Mailer;


use Illuminate\Support\Facades\Mail;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class MailMan
{
    /**
     * @var CssToInlineStyles
     */
    private $cssToInlineStyles;

    private $html;


    /**
     * HtmlMailer constructor.
     * @param CssToInlineStyles $cssToInlineStyles
     */
    public function __construct(CssToInlineStyles $cssToInlineStyles)
    {
        $this->cssToInlineStyles = $cssToInlineStyles;
    }

    public function prepare($htmlView, array $data = [], array $styles = [])
    {

        $html = view($htmlView)
            ->with($data)
            ->render();

        $css = file_get_contents(public_path('assets/canvas/css/bootstrap.css'));
        $css .= file_get_contents(public_path('build/css/site.theme.min.css'));

        $this->html = $this->cssToInlineStyles->convert($html, $css);

        return $this;
    }

    public function send($email, $subject = '')
    {
        \Mail::send('mailmessenger::emails.custom-html-mail', ['custom_html' => $this->html], function ($message) use($email, $subject){
            $message
                ->to($email)
                ->subject($subject)
            ;
        });
    }
}