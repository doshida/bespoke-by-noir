<?php
declare(strict_types=1);

/**
 * The editable content model. One entry per JSON file in /data.
 * Field types: string (single-line), text (textarea, plain), text-nl (textarea,
 * newline -> <br>, no italic), text-rich (textarea, *word*->italic + newline->br),
 * image (file upload + current-value preview), boolean (checkbox),
 * group (nested object -> 'fields'), list (repeatable object -> 'fields'),
 * list-string (repeatable plain values; 'itemType' string|text, default string).
 */
function noir_schema(): array
{
    $seoFields = [
        ['name' => 'title', 'label' => 'Page title (SEO)', 'type' => 'string'],
        ['name' => 'description', 'label' => 'Page description (SEO)', 'type' => 'text'],
    ];

    return [
        'site' => [
            'label' => 'Global · Navigation & Footer',
            'fields' => [
                ['name' => 'brand', 'label' => 'Brand name', 'type' => 'string'],
                ['name' => 'nav', 'label' => 'Navigation links', 'type' => 'list', 'fields' => [
                    ['name' => 'label', 'type' => 'string'],
                    ['name' => 'href', 'label' => 'Link (e.g. atelier.php)', 'type' => 'string'],
                ]],
                ['name' => 'cta', 'label' => 'Header button', 'type' => 'group', 'fields' => [
                    ['name' => 'label', 'type' => 'string'],
                    ['name' => 'href', 'type' => 'string'],
                ]],
                ['name' => 'footer', 'label' => 'Footer', 'type' => 'group', 'fields' => [
                    ['name' => 'blurb', 'label' => 'Address blurb', 'type' => 'text-nl', 'hint' => 'New line = line break.'],
                    ['name' => 'houseHeading', 'label' => '"The House" column heading', 'type' => 'string'],
                    ['name' => 'commissionHeading', 'label' => '"Commission" column heading', 'type' => 'string'],
                    ['name' => 'email', 'type' => 'string'],
                    ['name' => 'instagram', 'label' => 'Instagram URL', 'type' => 'string'],
                    ['name' => 'copyright', 'type' => 'string'],
                ]],
            ],
        ],

        'home' => [
            'label' => 'Home',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'hero', 'label' => 'Hero', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'label' => 'Background image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'label' => 'Image alt text', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'label' => 'Headline', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic. New line = line break.'],
                    ['name' => 'sub', 'label' => 'Sub-text', 'type' => 'text'],
                    ['name' => 'ctaPrimaryLabel', 'label' => 'Primary button text', 'type' => 'string'],
                    ['name' => 'ctaPrimaryHref', 'label' => 'Primary button link', 'type' => 'string'],
                    ['name' => 'ctaSecondaryLabel', 'label' => 'Text link', 'type' => 'string'],
                    ['name' => 'ctaSecondaryHref', 'label' => 'Text link href', 'type' => 'string'],
                ]],
                ['name' => 'invitation', 'label' => 'The Invitation', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'figtag', 'label' => 'Image caption', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'lead', 'type' => 'text'],
                    ['name' => 'body', 'type' => 'text'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                    ['name' => 'linkHref', 'type' => 'string'],
                ]],
                ['name' => 'ritual', 'label' => 'The Ritual', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'acts', 'label' => 'Cards', 'type' => 'list', 'fields' => [
                        ['name' => 'image', 'type' => 'image'],
                        ['name' => 'imageAlt', 'type' => 'string'],
                        ['name' => 'number', 'label' => 'Label (e.g. I — III)', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                        ['name' => 'desc', 'type' => 'text'],
                    ]],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
                ['name' => 'atelierBand', 'label' => 'The Atelier band', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic. New line = line break.'],
                    ['name' => 'body', 'type' => 'text'],
                    ['name' => 'sealText', 'label' => 'Seal text', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'locationLabel', 'type' => 'string'],
                    ['name' => 'location', 'type' => 'string'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                    ['name' => 'linkHref', 'type' => 'string'],
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                ]],
                ['name' => 'distinction', 'label' => 'For the C-suite section', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'figtag', 'label' => 'Image caption', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic. New line = line break.'],
                    ['name' => 'body', 'type' => 'text'],
                    ['name' => 'bullets', 'label' => 'Bullet points', 'type' => 'list-string'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                    ['name' => 'linkHref', 'type' => 'string'],
                ]],
                ['name' => 'commissions', 'label' => 'Recent Commissions (carousel)', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                    ['name' => 'linkHref', 'type' => 'string'],
                    ['name' => 'cards', 'label' => 'Cards', 'type' => 'list', 'fields' => [
                        ['name' => 'image', 'type' => 'image'],
                        ['name' => 'imageAlt', 'type' => 'string'],
                        ['name' => 'occasion', 'label' => 'Occasion tag', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic.'],
                        ['name' => 'cloth', 'label' => 'Cloth detail', 'type' => 'string'],
                        ['name' => 'tone', 'label' => 'Dim & warm this photo (for bright images)', 'type' => 'boolean'],
                        ['name' => 'href', 'type' => 'string'],
                    ]],
                ]],
                ['name' => 'testimonials', 'label' => 'Testimonials', 'type' => 'list', 'fields' => [
                    ['name' => 'quote', 'type' => 'text'],
                    ['name' => 'by', 'label' => 'Attribution', 'type' => 'string'],
                ]],
                ['name' => 'cta', 'label' => 'Closing call-to-action', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'label' => 'Background image', 'type' => 'image'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
            ],
        ],

        'atelier' => [
            'label' => 'The Atelier',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'header', 'label' => 'Page header', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                ]],
                ['name' => 'founder', 'label' => 'Founder', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'figtag', 'label' => 'Image caption', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'body', 'label' => 'Paragraphs', 'type' => 'list-string', 'itemType' => 'text'],
                    ['name' => 'pullQuote', 'type' => 'text'],
                ]],
                ['name' => 'codes', 'label' => 'House codes', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'items', 'type' => 'list', 'fields' => [
                        ['name' => 'number', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                        ['name' => 'desc', 'type' => 'text'],
                    ]],
                ]],
                ['name' => 'space', 'label' => 'The Space', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'items', 'type' => 'list', 'fields' => [
                        ['name' => 'image', 'type' => 'image'],
                        ['name' => 'imageAlt', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                        ['name' => 'desc', 'type' => 'string'],
                    ]],
                ]],
                ['name' => 'cta', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'label' => 'Background image', 'type' => 'image'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
            ],
        ],

        'process' => [
            'label' => 'The Process',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'header', 'label' => 'Page header', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                ]],
                ['name' => 'acts', 'label' => 'Steps', 'type' => 'list', 'fields' => [
                    ['name' => 'number', 'type' => 'string'],
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'string'],
                    ['name' => 'desc', 'type' => 'text'],
                ]],
                ['name' => 'cta', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'label' => 'Background image', 'type' => 'image'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
            ],
        ],

        'commissions' => [
            'label' => 'Commissions gallery',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'header', 'label' => 'Page header', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                ]],
                ['name' => 'filters', 'label' => 'Filter buttons', 'type' => 'list', 'fields' => [
                    ['name' => 'label', 'type' => 'string'],
                    ['name' => 'key', 'label' => 'Key (all / business / blacktie / ceremony)', 'type' => 'string'],
                ]],
                ['name' => 'items', 'label' => 'Gallery items', 'type' => 'list', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'occasionKey', 'label' => 'Filter key (business / blacktie / ceremony)', 'type' => 'string'],
                    ['name' => 'occasionLabel', 'label' => 'Occasion tag', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic.'],
                    ['name' => 'tone', 'label' => 'Dim & warm this photo (for bright images)', 'type' => 'boolean'],
                ]],
                ['name' => 'cta', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
            ],
        ],

        'weddings' => [
            'label' => 'Weddings',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'hero', 'label' => 'Hero', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'label' => 'Headline', 'type' => 'text-rich', 'hint' => 'Wrap a word in *asterisks* for gold italic. New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                    ['name' => 'ctaPrimaryLabel', 'type' => 'string'],
                    ['name' => 'ctaPrimaryHref', 'type' => 'string'],
                    ['name' => 'ctaSecondaryLabel', 'type' => 'string'],
                    ['name' => 'ctaSecondaryHref', 'type' => 'string'],
                ]],
                ['name' => 'invitation', 'label' => 'The Invitation', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'figtag', 'label' => 'Image caption', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'lead', 'type' => 'text'],
                    ['name' => 'body', 'type' => 'text'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                    ['name' => 'linkHref', 'type' => 'string'],
                ]],
                ['name' => 'offerings', 'label' => 'The Occasions', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'items', 'type' => 'list', 'fields' => [
                        ['name' => 'image', 'type' => 'image'],
                        ['name' => 'imageAlt', 'type' => 'string'],
                        ['name' => 'number', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                        ['name' => 'desc', 'type' => 'text'],
                        ['name' => 'href', 'type' => 'string'],
                    ]],
                ]],
                ['name' => 'process', 'label' => 'Wedding process (steps)', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                    ['name' => 'steps', 'type' => 'list', 'fields' => [
                        ['name' => 'number', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                        ['name' => 'desc', 'type' => 'text'],
                    ]],
                ]],
                ['name' => 'gallery', 'label' => 'Real Weddings gallery', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'items', 'type' => 'list', 'fields' => [
                        ['name' => 'image', 'type' => 'image'],
                        ['name' => 'imageAlt', 'type' => 'string'],
                        ['name' => 'occasionLabel', 'label' => 'Tag', 'type' => 'string'],
                        ['name' => 'title', 'type' => 'string'],
                    ]],
                ]],
                ['name' => 'testimonials', 'type' => 'list', 'fields' => [
                    ['name' => 'quote', 'type' => 'text'],
                    ['name' => 'by', 'type' => 'string'],
                ]],
                ['name' => 'cta', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'label' => 'Background image', 'type' => 'image'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'heading', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'sub', 'type' => 'text'],
                    ['name' => 'buttonLabel', 'type' => 'string'],
                    ['name' => 'buttonHref', 'type' => 'string'],
                ]],
            ],
        ],

        'appointment' => [
            'label' => 'Request an Appointment',
            'fields' => [
                ['name' => 'seo', 'type' => 'group', 'fields' => $seoFields],
                ['name' => 'aside', 'label' => 'Side panel', 'type' => 'group', 'fields' => [
                    ['name' => 'image', 'type' => 'image'],
                    ['name' => 'imageAlt', 'type' => 'string'],
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'lead', 'type' => 'string'],
                ]],
                ['name' => 'form', 'type' => 'group', 'fields' => [
                    ['name' => 'eyebrow', 'type' => 'string'],
                    ['name' => 'title', 'type' => 'text-rich', 'hint' => 'New line = line break.'],
                    ['name' => 'reassurance', 'type' => 'text'],
                    ['name' => 'occasions', 'label' => 'Occasion dropdown options', 'type' => 'list-string'],
                    ['name' => 'submitLabel', 'type' => 'string'],
                    ['name' => 'disclaimer', 'type' => 'text'],
                ]],
                ['name' => 'confirm', 'label' => 'Confirmation message', 'type' => 'group', 'fields' => [
                    ['name' => 'heading', 'type' => 'string'],
                    ['name' => 'body', 'type' => 'text'],
                    ['name' => 'linkLabel', 'type' => 'string'],
                ]],
            ],
        ],
    ];
}
