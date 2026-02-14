<?php

return [
    'company' => [
        'name' => 'Imaging Services',
        'legal_name' => 'Imaging Services, Inc.',
        'tagline' => 'Your place for medical imaging equipment and supplies.',
        'phone_toll_free' => '+1 (866) 227-9290',
        'phone_primary' => '+1 (610) 543-2333',
        'email_orders' => 'orders@imagingservices.net',
        'email_sales' => 'sales@imagingservicesusa.com',
        'hq_address' => '1260 Woodland Ave, Unit 12, Springfield, PA 19064',
        'states_served' => ['Pennsylvania', 'Maryland', 'Florida', 'Connecticut'],
    ],

    'hours' => [
        ['day' => 'Monday', 'hours' => '8:30 am - 5 pm'],
        ['day' => 'Tuesday', 'hours' => '8:30 am - 5 pm'],
        ['day' => 'Wednesday', 'hours' => '8:30 am - 5 pm'],
        ['day' => 'Thursday', 'hours' => '8:30 am - 5 pm'],
        ['day' => 'Friday', 'hours' => '8:30 am - 5 pm'],
        ['day' => 'Saturday', 'hours' => 'Closed'],
        ['day' => 'Sunday', 'hours' => 'Closed'],
    ],

    'partners' => [
        ['name' => '20/20 Imaging', 'logo' => '/site-assets/images/partners/2020.png'],
        ['name' => 'AGFA', 'logo' => '/site-assets/images/partners/agfa.png'],
        ['name' => 'Americomp', 'logo' => '/site-assets/images/partners/americomp.png'],
        ['name' => 'Amrad Medical', 'logo' => '/site-assets/images/partners/amrad.png'],
        ['name' => 'Del Medical', 'logo' => '/site-assets/images/partners/del-medical.png'],
        ['name' => 'FUJI', 'logo' => '/site-assets/images/partners/fuji.png'],
        ['name' => 'ImageWorks', 'logo' => '/site-assets/images/partners/imageworks.png'],
        ['name' => 'InnoVet', 'logo' => '/site-assets/images/partners/innovet.png'],
        ['name' => 'Konica Minolta', 'logo' => '/site-assets/images/partners/konica.png'],
        ['name' => 'Rayence', 'logo' => '/site-assets/images/partners/rayence.png'],
        ['name' => 'Shielding', 'logo' => '/site-assets/images/partners/shielding.png'],
        ['name' => 'Techno-Aide', 'logo' => '/site-assets/images/partners/techno-aide.png'],
    ],

    'home' => [
        'hero' => [
            'headline' => 'Products and Services with Quality',
            'subheadline' => 'Consider your X-ray imaging problems fully solved with us.',
            'summary' => 'Imaging Services Inc. is your source for CR and DR digital imaging, X-ray equipment, accessories, and service support. We provide room drawings, installations, removals, relocations, disposal of old equipment, and retrofits for existing rooms.',
            'image' => '/site-assets/images/home/hero-medical.jpg',
            'primary_cta' => ['label' => 'See All Equipment', 'route' => 'equipment'],
            'secondary_cta' => ['label' => 'Contact Sales', 'route' => 'contact'],
        ],
        'advantages' => [
            'Our customers are the backbone of our company, and we respond with precision.',
            'Consider your X-ray imaging problems fully solved with us.',
            'Our experts are trained to deliver quality, cost-efficient service.',
            'Our response times to all customers are legendary.',
        ],
        'categories' => [
            [
                'title' => 'Chiropractic X-Ray',
                'subtitle' => 'Straight Arm and DR Solutions',
                'image' => '/site-assets/images/equipment/chiropractic.jpg',
                'slug' => 'chiropractic-x-ray',
            ],
            [
                'title' => 'Podiatry X-Ray',
                'subtitle' => 'HF PXS-710 X-Ray',
                'image' => '/site-assets/images/equipment/podiatry.jpg',
                'slug' => 'podiatry-x-ray',
            ],
            [
                'title' => 'Veterinary X-Ray',
                'subtitle' => 'VetSmart and InnoVet Systems',
                'image' => '/site-assets/images/equipment/veterinary.jpg',
                'slug' => 'veterinary-x-ray',
            ],
            [
                'title' => 'Mobile X-Ray',
                'subtitle' => 'SR-130 Mobile X-Ray',
                'image' => '/site-assets/images/equipment/mobile.jpg',
                'slug' => 'mobile-x-ray',
            ],
        ],
        'testimonials' => [
            [
                'quote' => 'Quick shout out and thanks to Michael Tokash and 20/20 Imaging. Great customer service and fast technical support.',
                'author' => 'Savona Family Chiropractic',
                'location' => 'Pennsylvania',
                'image' => '/site-assets/images/testimonials/savona.jpg',
            ],
            [
                'quote' => 'Mike Tokash and his team retrofitted my X-ray unit and helped work out every kink along the way. Highly recommended.',
                'author' => 'Verified Imaging Services Customer',
                'location' => 'USA',
                'image' => '/site-assets/images/testimonials/derek-kasten.jpg',
            ],
            [
                'quote' => 'Mike and Jeff came out to Montana and set us up. They go above and beyond and truly back up their clients.',
                'author' => 'Everest Group',
                'location' => 'Montana',
                'image' => '/site-assets/images/testimonials/everest.jpg',
            ],
            [
                'quote' => 'For DR X-ray systems and tech support, follow-up post-sale is ridiculously good and responsive.',
                'author' => 'Derek M. Kasten, DC',
                'location' => 'One Love Chiropractic',
                'image' => '/site-assets/images/testimonials/derek-kasten.jpg',
            ],
        ],
    ],

    'about' => [
        'intro' => 'Imaging Services is a leader in radiology products and services, serving clinics from the Philadelphia suburbs across the United States.',
        'supporting' => 'From the second we pick up the phone and hear your concerns, we get to work. Every account is managed with care and follow-through.',
        'team' => [
            ['name' => 'Kathryn Tokash', 'role' => 'Business Owner', 'image' => '/site-assets/images/team/kathryn-tokash.png'],
            ['name' => 'Paul McCabe', 'role' => 'Vice President of Sales', 'image' => '/site-assets/images/team/paul-mccabe.jpg'],
            ['name' => 'Jordan Desjardins', 'role' => 'Office Manager', 'image' => '/site-assets/images/team/jordan-desjardins.jpg'],
            ['name' => 'Stephen Sawyer', 'role' => 'Director of IT', 'image' => '/site-assets/images/team/stephen-sawyer.jpg'],
            ['name' => 'Jeff Brandt', 'role' => 'Service Manager', 'image' => '/site-assets/images/team/jeff-brandt.jpg'],
            ['name' => 'Damien Gamble', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/damien-gamble.jpg'],
            ['name' => 'Tim Conrad', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/tim-conrad.jpg'],
        ],
    ],

    'equipment' => [
        'intro' => [
            'Imaging Services provides CR and DR, X-ray, and film processor service for your imaging modality needs.',
            'Computed and direct radiography continue to replace film and chemicals as the clinical standard.',
            'We handle room drawings, installations, removals, relocations, disposal of old equipment, and retrofit projects.',
            'We support top manufacturers including Del Medical, Fuji, 20/20 Imaging, AMRAD, ImageWorks, Summit, Konica, and more.',
        ],
        'categories' => [
            ['name' => 'Chiropractic X-Ray', 'slug' => 'chiropractic-x-ray', 'image' => '/site-assets/images/equipment/category-chiropractic.jpg'],
            ['name' => 'Podiatry X-Ray', 'slug' => 'podiatry-x-ray', 'image' => '/site-assets/images/equipment/category-podiatry.jpg'],
            ['name' => 'Veterinary X-Ray', 'slug' => 'veterinary-x-ray', 'image' => '/site-assets/images/equipment/category-veterinary.jpg'],
            ['name' => 'Mobile X-Ray', 'slug' => 'mobile-x-ray', 'image' => '/site-assets/images/equipment/category-mobile.jpg'],
            ['name' => 'Extentrac Elite M3D Device', 'slug' => 'extentrac-elite-m3d-device', 'image' => '/site-assets/images/equipment-detail/extentrac.jpg'],
            ['name' => 'Smart-C Portable Mini C-Arm', 'slug' => 'smart-c-portable-mini-c-arm', 'image' => '/site-assets/images/equipment-detail/smart-c.jpg'],
            ['name' => 'Planmeca Viso for Chiropractic', 'slug' => 'planmeca-viso-for-chiropractic', 'image' => '/site-assets/images/equipment/chiropractic.jpg'],
            ['name' => 'Planmed Verity Orthopedic Imaging', 'slug' => 'planmed-verity-orthopedic-imaging', 'image' => '/site-assets/images/equipment-detail/planmed-verity.jpg'],
            ['name' => 'Orthopedic / Urgent Care', 'slug' => 'orthopedic-urgent-care', 'image' => '/site-assets/images/equipment/veterinary.jpg'],
        ],
    ],

    'equipment_details' => [
        'chiropractic-x-ray' => [
            'title' => 'Chiropractic X-Ray',
            'subtitle' => 'Straight-arm and digital-ready chiropractic imaging systems with on-site install and training.',
            'image' => '/site-assets/images/equipment/category-chiropractic.jpg',
            'highlights' => [
                'On-site install and training by certified imaging specialists.',
                'AMERICOMP AC1 and AC2 systems plus chiropractic table integration options.',
                'Retrofit DR panel options with Opal software and full-spine workflow support.',
            ],
        ],
        'podiatry-x-ray' => [
            'title' => 'Podiatry X-Ray',
            'subtitle' => 'HF PXS-710 systems with DR panel choices built for podiatry throughput.',
            'image' => '/site-assets/images/equipment/category-podiatry.jpg',
            'highlights' => [
                'HF PXS-710 high-frequency output with low base positioning.',
                'Wireless and tethered panel options for flexible room layouts.',
                'Opal-RAD software, podiatric tool set, and cloud backup options.',
            ],
        ],
        'veterinary-x-ray' => [
            'title' => 'Veterinary X-Ray',
            'subtitle' => 'VetSmart and InnoVet systems with DR panel options for veterinary imaging.',
            'image' => '/site-assets/images/equipment/category-veterinary.jpg',
            'highlights' => [
                'VetSmart and Summit InnoVet Select HF digital-ready configurations.',
                'Multiple wireless, hybrid, and tethered panel choices for veterinary workflows.',
                'Veterinary measurement tools, preset exams, and cloud backup support.',
            ],
        ],
        'mobile-x-ray' => [
            'title' => 'Mobile X-Ray',
            'subtitle' => 'SR-130 mobile systems designed for high output and portable diagnostic access.',
            'image' => '/site-assets/images/equipment/category-mobile.jpg',
            'highlights' => [
                'SR-130 high-frequency mobile unit with strong power-to-weight performance.',
                'Wireless panel options with software integration and fast acquisition.',
                'Laptop and workstation integrations with optional live cloud backup.',
            ],
        ],
        'extentrac-elite-m3d-device' => [
            'title' => 'Extentrac Elite M3D Device',
            'subtitle' => 'A patented, FDA-cleared therapeutic device for severe low back pain and sciatica treatment workflows.',
            'image' => '/site-assets/images/equipment-detail/extentrac.jpg',
            'highlights' => [
                'Combines manual therapy and automated decompression in one system.',
                'M3D positioning supports flexion, extension, and lateral flexion protocols.',
                'Includes therapeutic exercise and decompression capabilities for versatile treatment plans.',
            ],
            'brochure' => '/site-assets/docs/extentrac-elite-brochure.pdf',
        ],
        'smart-c-portable-mini-c-arm' => [
            'title' => 'Smart-C Portable Mini C-Arm',
            'subtitle' => 'Small-footprint, battery-operated mini C-arm built for surgical, clinical, and sports medicine imaging.',
            'image' => '/site-assets/images/equipment-detail/smart-c.jpg',
            'highlights' => [
                'True portable form factor with full capability for point-of-care imaging.',
                'Battery-powered and wireless architecture minimizes OR and clinic clutter.',
                'Designed to support faster diagnostics and procedure workflows.',
            ],
            'brochure' => '/site-assets/docs/smart-c-brochure.pdf',
        ],
        'planmeca-viso-for-chiropractic' => [
            'title' => 'Planmeca Viso for Chiropractic',
            'subtitle' => 'Flagship CBCT imaging with premium image quality and high-end usability.',
            'image' => '/site-assets/images/equipment/chiropractic.jpg',
            'highlights' => [
                'Flexible volume sizes across Viso G7 and G5 platforms.',
                'Live virtual FOV positioning with integrated camera workflow.',
                'Ultra low dose imaging protocol with advanced head and neck diagnostics.',
            ],
        ],
        'planmed-verity-orthopedic-imaging' => [
            'title' => 'Planmed Verity Orthopedic Imaging',
            'subtitle' => 'Point-of-care extremity CT with high-quality 3D imaging at low dose.',
            'image' => '/site-assets/images/equipment-detail/planmed-verity.jpg',
            'highlights' => [
                'Weight-bearing 3D imaging for foot, ankle, knee, and extremity diagnostics.',
                'Integrated workstation and patient-friendly positioning workflows.',
                'Low-dose protocol options with published clinical validation.',
            ],
        ],
        'orthopedic-urgent-care' => [
            'title' => 'Orthopedic / Urgent Care',
            'subtitle' => 'High-throughput orthopedic and urgent care imaging solutions with dependable service coverage.',
            'image' => '/site-assets/images/equipment/veterinary.jpg',
            'highlights' => [
                'Planmed Verity point-of-care extremity CT options for orthopedic use.',
                'DFMT Elite radiology systems built for high patient throughput.',
                'AMRAD high-frequency generators customizable to facility requirements.',
            ],
        ],
    ],

    'accessories' => [
        'summary' => 'View and select from our accessories catalog for daily imaging workflow needs.',
        'notes' => [
            'Browse the mini accessories catalog and open pages full-screen for detail.',
            'Contact us for discounted pricing and ordering support by phone or email.',
            'Download the order form and return it by email or fax for prompt processing.',
        ],
        'catalog_pdf' => '/site-assets/docs/accessories-catalog.pdf',
        'catalog_image' => '/site-assets/images/accessories/grid.jpg',
    ],

    'services' => [
        'intro' => 'Our trained service engineers have the knowledge and field experience to keep your imaging business running.',
        'service_options' => [
            'Setup and Configuration',
            'Equipment Evaluation / Consultation',
            'Equipment Maintenance',
            'Site Planning',
            'On-Demand Repairs',
            'Quality Control',
            'Remote Support',
            'Equipment Moves / Delivery',
        ],
        'training_options' => [
            'Learn equipment hardware and software familiarity',
            'Apply best practices to improve your workflow',
            'Train for a variety of real imaging scenarios',
            'Get direct answers to operational and technical questions',
        ],
        'parts_summary' => 'We provide access to new, refurbished, and used parts for both current and legacy imaging systems.',
        'brands' => ['20/20 Imaging', 'AGFA', 'Amrad Medical', 'Del Medical', 'FUJI', 'ImageWorks', 'Konica Minolta', 'Summit'],
    ],

    'payments' => [
        'mailing' => [
            'company' => 'IMAGING SERVICES, Inc.',
            'address' => 'PO Box 123, Morton, PA 19070',
        ],
        'bank_transfer' => [
            'title' => 'Bank Transfer and Wire Payments',
            'note' => 'For transfer instructions and remittance confirmation, contact our office at +1 (610) 543-2333.',
        ],
        'card_note' => 'We accept all major credit cards. To make a card payment, call +1 (610) 543-2333. Payment details are handled securely and are not stored unless authorized by you.',
    ],

    'contact' => [
        'headline' => 'Contact us for any questions',
        'subhead' => 'Call or visit us in Springfield, PA. Office phone: +1 (610) 543-2333. Mon-Fri: 8:30 am - 5:00 pm.',
        'principals' => [
            ['name' => 'Jim Kreiger', 'phone' => '+1 (410) 513-6840'],
            ['name' => 'Michael Tokash', 'phone' => '+1 (610) 812-3079'],
        ],
        'locations' => [
            'PA' => '1260 Woodland Ave, Unit 12, Springfield, PA 19064',
            'MD' => '9603 Amberleigh Ln, Perry Hall, MD 21128',
            'CT' => '31 Killingworth Turnpike, Clinton, CT 06413',
            'FL' => '1111 Arrowhead Point Road, Loxahatchee, FL 33470',
        ],
        'support_contacts' => [
            ['name' => 'Jeff Brandt', 'role' => 'Service Manager', 'email' => 'jbrandt@imagingservices.net'],
            ['name' => 'Paul McCabe', 'role' => 'Sales Manager', 'email' => 'pmccabe@imagingservices.net'],
            ['name' => 'Stephen Sawyer', 'role' => 'IT and Cloud Support', 'email' => 'ssawyer@imagingservices.net', 'phone' => '+1 (610) 301-8105'],
            ['name' => 'Jordan Desjardins', 'role' => 'Office Manager', 'email' => 'jdesjardins@imagingservices.net'],
        ],
    ],

    'privacy' => [
        'effective_date' => 'February 25, 2022',
        'summary' => 'This policy explains how Imaging Services, Inc. collects, uses, and protects personal information provided through this website and related requests.',
        'sections' => [
            [
                'title' => 'Information Collection and Use',
                'body' => [
                    'We collect contact information such as name, email, phone, and address details needed to respond to equipment and service requests.',
                    'You may opt in or opt out of additional product and service updates by email, phone, or SMS.',
                    'We use reasonable safeguards to keep personal information secure and do not share it without your authorization.',
                ],
            ],
            [
                'title' => 'Computer Information Collected',
                'body' => [
                    'This site may use cookies and essential technical data, including IP address information, to deliver pages and improve site functionality.',
                    'You can disable cookies in your browser, but some site features may not function as expected.',
                    'If you have technical questions, you can contact site support directly through our contact channels.',
                ],
            ],
            [
                'title' => 'Terms of Service',
                'body' => [
                    'Use of this website indicates acceptance of current terms and conditions.',
                    'Imaging Services may update terms and this policy by posting changes on this page.',
                    'If you do not accept these terms, do not use the website.',
                ],
            ],
        ],
    ],

    'marketing_pages' => [
        'used-equipment' => [
            'title' => 'Used Equipment',
            'description' => 'Call us for current used imaging inventory and purchase availability.',
            'body' => [
                'Our used equipment page is actively updated with available inventory such as mobile X-ray units and tables.',
                'For current stock and pricing, call our team directly and request used-equipment sales support.',
            ],
            'cta' => ['label' => 'Contact Sales', 'route' => 'contact'],
        ],
        'october-2024-message' => [
            'title' => 'October 2024',
            'description' => 'Video update from the Imaging Services team.',
            'body' => [
                'This page currently contains a hosted video message from Kathryn Tokash for customers and partners.',
                'Contact our team if you need details related to the update or upcoming equipment plans.',
            ],
            'cta' => ['label' => 'Talk to Our Team', 'route' => 'contact'],
        ],
        'promo-eq-summer-24' => [
            'title' => 'End of Summer Equipment Promotion',
            'description' => 'Limited-time equipment discounts for the first 30 qualifying customers.',
            'body' => [
                'The promotion page currently highlights coupon tiers for $500, $1,000, and $1,500 discounts on selected equipment.',
                'Submit your details through the promotion form to claim available discount codes before inventory windows close.',
            ],
            'cta' => ['label' => 'Get Promotion Details', 'route' => 'contact'],
        ],
        'careers' => [
            'title' => 'Imaging Services Careers',
            'description' => 'We are hiring for service and office support roles.',
            'body' => [
                'We are actively looking for skilled associates in digital service technician and office support roles.',
                'You can submit your resume to vgamble@imagingservicesusa.com or mtokash@imagingservicesusa.com.',
            ],
            'cta' => ['label' => 'Contact Careers Team', 'route' => 'contact'],
        ],
        'refund_returns' => [
            'title' => 'Refund and Returns Policy',
            'description' => 'Current returns guidance and product-specific terms.',
            'body' => [
                'The live page includes returns and refund guidance plus product-specific content currently shown in WordPress.',
                'For order-specific return eligibility and timelines, contact our team with your invoice and item details.',
            ],
            'cta' => ['label' => 'Request Return Support', 'route' => 'contact'],
        ],
        'shop' => [
            'title' => 'Shop',
            'description' => 'Online storefront for current products and featured equipment.',
            'body' => [
                'The shop page currently surfaces available products and integrates with WordPress storefront tools.',
                'If you do not see the item you need, contact Imaging Services directly for a guided quote.',
            ],
            'cta' => ['label' => 'Contact Sales', 'route' => 'contact'],
        ],
        'compare' => [
            'title' => 'Compare',
            'description' => 'Storefront comparison page for product selection workflows.',
            'body' => [
                'This page is currently a comparison utility endpoint in the WordPress storefront.',
                'For assisted comparisons across imaging systems, contact our sales team directly.',
            ],
            'cta' => ['label' => 'Start a Comparison', 'route' => 'contact'],
        ],
        'wishlist' => [
            'title' => 'Wishlist',
            'description' => 'Storefront wishlist endpoint for saved product interests.',
            'body' => [
                'The live site publishes this page as a storefront wishlist utility endpoint.',
                'For a custom quote list, send your desired products to our team and we will prepare recommendations.',
            ],
            'cta' => ['label' => 'Send Your Wishlist', 'route' => 'contact'],
        ],
        'maintenance-page' => [
            'title' => 'Maintenance Page',
            'description' => 'Coming back soon page used for maintenance windows.',
            'body' => [
                'The current message states that the website is being upgraded and will be available again soon.',
                'If you need immediate support while this page is active, contact Imaging Services directly.',
            ],
            'cta' => ['label' => 'Contact Support', 'route' => 'contact'],
        ],
    ],

    'blog_posts' => [
        'the-economics-of-digital-x-ray-is-it-actually-saving-you-money' => [
            'title' => 'The Economics of Digital X-Ray: Is It Actually Saving You Money?',
            'published' => 'April 2, 2025',
            'summary' => 'A practical breakdown of the real costs of film-based imaging compared with digital X-ray workflows.',
            'content' => [
                'This article reviews recurring costs such as film, chemicals, storage, and technician time and compares them with digital operating costs.',
                'It also covers ROI timelines, productivity gains, and financing considerations practices should evaluate before upgrading.',
            ],
        ],
        'reducing-radiation-exposure-how-modern-digital-x-ray-systems-are-making-imaging-safer' => [
            'title' => 'Reducing Radiation Exposure: How Modern Digital X-Ray Systems Are Making Imaging Safer',
            'published' => 'March 26, 2025',
            'summary' => 'How modern digital systems, AI processing, and dose controls are reducing radiation exposure for patients and staff.',
            'content' => [
                'The post explains how detector sensitivity and software improvements can lower dose while preserving diagnostic quality.',
                'It also outlines practical safety steps for clinics, including protocol governance and system-level dose monitoring.',
            ],
        ],
        'the-future-of-digital-x-ray-5-game-changing-innovations-to-watch' => [
            'title' => 'The Future of Digital X-Ray: 5 Game-Changing Innovations to Watch',
            'published' => 'March 19, 2025',
            'summary' => 'A look at AI, mobile imaging, lower-dose technology, cloud workflows, and 3D imaging trends shaping digital radiology.',
            'content' => [
                'The article highlights innovations changing how providers capture, process, and review imaging data.',
                'It focuses on operational impact, including faster diagnostics, improved access, and more flexible care delivery.',
            ],
        ],
        'beyond-the-basics-how-to-maximize-the-roi-of-your-digital-x-ray-equipment' => [
            'title' => 'Beyond the Basics: How to Maximize the ROI of Your Digital X-Ray Equipment',
            'published' => 'March 12, 2025',
            'summary' => 'Operational tactics for improving ROI after a digital X-ray investment.',
            'content' => [
                'This piece covers workflow optimization, software updates, maintenance planning, and remote access strategy.',
                'It emphasizes reducing avoidable downtime and improving throughput to increase long-term return on investment.',
            ],
        ],
        'why-your-x-ray-processor-is-holding-you-back-5-signs-its-time-for-a-change' => [
            'title' => 'Why Your X-Ray Processor is Holding You Back: 5 Signs It\'s Time for a Change',
            'published' => 'March 6, 2025',
            'summary' => 'Five warning signs that outdated processing workflows are reducing speed, quality, and patient experience.',
            'content' => [
                'The article walks through image quality issues, maintenance cost creep, workflow delays, and compliance risk.',
                'It concludes with practical next steps for evaluating digital replacement options and consultation planning.',
            ],
        ],
        'the-hidden-costs-of-outdated-x-ray-processors-is-it-time-to-upgrade' => [
            'title' => 'The Hidden Costs of Outdated X-Ray Processors - Is It Time to Upgrade?',
            'published' => 'February 26, 2025',
            'summary' => 'How legacy film-based processing creates hidden financial, operational, and compliance burdens.',
            'content' => [
                'The post quantifies direct costs, lost productivity, patient experience impact, and regulatory pressure tied to old systems.',
                'It also explains why financing and modern digital workflows can reduce risk and improve long-term economics.',
            ],
        ],
        'celebrating-45-years-of-services-in-digiting-imaging' => [
            'title' => 'Celebrating 45 Years of Services in Digiting Imaging',
            'published' => 'February 21, 2022',
            'summary' => 'A media feature highlighting Imaging Services milestones and long-term work in digital imaging support.',
            'content' => [
                'This post includes a 2021 interview segment and associated media references from the company archive.',
                'It reflects on long-standing customer service priorities and continued equipment support across markets.',
            ],
        ],
        'the-chiropractic-compass-podcast-interview-19' => [
            'title' => 'The Chiropractic Compass Podcast Interview 19',
            'published' => 'February 7, 2022',
            'summary' => 'Podcast and live media feature with Michael Tokash discussing digital imaging support topics.',
            'content' => [
                'This page hosts interview content from The Chiropractic Compass channel and related social live sessions.',
                'The discussion focuses on service quality, implementation support, and practical imaging operations.',
            ],
        ],
        'chiropractic-rocks-2019-interview-with-jim-chester' => [
            'title' => 'Chiropractic Rocks 2019 Interview with Jim Chester',
            'published' => 'January 9, 2022',
            'summary' => 'Archived interview and video content featuring Michael Tokash at Chiropractic Rocks 2019.',
            'content' => [
                'This media post includes social video highlights and event interview context from 2019.',
                'It is maintained as part of the company media archive and historical outreach content.',
            ],
        ],
        'are-you-an-active-participant-in-your-growth' => [
            'title' => 'Are You An Active Participant in Your Growth?',
            'published' => 'January 6, 2022',
            'summary' => 'A short video-focused archive post on business growth mindset and chiropractic practice momentum.',
            'content' => [
                'This archived media item emphasizes active business development and avoiding operational stagnation.',
                'It includes embedded video content from the company\'s earlier social interview series.',
            ],
        ],
    ],
];
