<?php

return [
    'company' => [
        'name' => 'Imaging Services',
        'legal_name' => 'Imaging Services, Inc.',
        'tagline' => 'Digital imaging equipment, service, and training for modern practices.',
        'phone_toll_free' => '+1 (866) 227-9290',
        'phone_primary' => '+1 (610) 812-3079',
        'email_orders' => 'orders@imagingservices.net',
        'email_sales' => 'sales@imagingservicesusa.com',
        'hq_address' => '1260 Woodland Ave, Unit 17B, Springfield, PA 19064',
        'states_served' => ['Pennsylvania', 'Delaware', 'Maryland', 'New Jersey', 'New York'],
    ],

    'hours' => [
        ['day' => 'Monday', 'hours' => '8:30 am - 5:00 pm'],
        ['day' => 'Tuesday', 'hours' => '8:30 am - 5:00 pm'],
        ['day' => 'Wednesday', 'hours' => '8:30 am - 5:00 pm'],
        ['day' => 'Thursday', 'hours' => '8:30 am - 5:00 pm'],
        ['day' => 'Friday', 'hours' => '8:30 am - 5:00 pm'],
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
            'subheadline' => 'Consider your x-ray imaging problems fully solved with us.',
            'summary' => 'We sell and service digital X-ray systems for Chiropractic, Podiatry, Veterinary, Orthopedic, and Mobile applications.',
            'image' => '/site-assets/images/home/hero-medical.jpg',
            'primary_cta' => ['label' => 'See All Equipment', 'route' => 'equipment'],
            'secondary_cta' => ['label' => 'Contact Sales', 'route' => 'contact'],
        ],
        'advantages' => [
            'Our response times to all customers are legendary.',
            'Our experts are trained for quality, cost-efficient service.',
            'No-charge consultation for workflows, site planning, and upgrades.',
            'Full suite of products with prompt service and enduring support.',
        ],
        'categories' => [
            [
                'title' => 'Chiropractic X-Ray',
                'subtitle' => 'Straight Arm X-Ray',
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
                'subtitle' => 'VXR X-Ray',
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
                'location' => 'Dublin, Pennsylvania',
                'image' => '/site-assets/images/testimonials/savona.jpg',
            ],
            [
                'quote' => 'For DR systems and tech support, follow-up post-sale has been ridiculously good and responsive.',
                'author' => 'Daniel Jacobazzi',
                'location' => 'Align Joint & Spine',
                'image' => '/site-assets/images/testimonials/derek-kasten.jpg',
            ],
            [
                'quote' => 'The team goes above and beyond to ensure every step is handled professionally.',
                'author' => 'Everest PhD 2.0',
                'location' => 'Texas',
                'image' => '/site-assets/images/testimonials/everest.jpg',
            ],
        ],
    ],

    'about' => [
        'intro' => 'Imaging Services is a leader in radiology products and services. The company is based in the Philadelphia suburbs and serves practices nationwide.',
        'supporting' => 'Our team handles customer accounts with care from first call to long-term service support.',
        'team' => [
            ['name' => 'Jim Kreiger', 'role' => 'Owner / CEO', 'image' => '/site-assets/images/team/jim-kreiger.jpg'],
            ['name' => 'Mike Tokash', 'role' => 'Owner / President', 'image' => '/site-assets/images/team/mike-tokash.jpg'],
            ['name' => 'Paul McCabe', 'role' => 'Vice President of Sales', 'image' => '/site-assets/images/team/paul-mccabe.jpg'],
            ['name' => 'Jeff Brandt', 'role' => 'Service Manager', 'image' => '/site-assets/images/team/jeff-brandt.jpg'],
            ['name' => 'Hans Stewart', 'role' => 'Director of Technical Support', 'image' => '/site-assets/images/team/hans-stewart.jpg'],
            ['name' => 'Veronica Gamble', 'role' => 'Operations Manager', 'image' => '/site-assets/images/team/veronica-gamble.jpg'],
            ['name' => 'Alyse Feldman', 'role' => 'Receptionist', 'image' => '/site-assets/images/team/alyse-feldman.jpg'],
            ['name' => 'Tim Conrad', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/tim-conrad.jpg'],
            ['name' => 'John Dailey', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/john-dailey.jpg'],
            ['name' => 'Damien Gamble', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/damien-gamble.jpg'],
            ['name' => 'Jan Nolt', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/jan-nolt.jpg'],
            ['name' => 'Adam Tokash', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/adam-tokash.jpg'],
            ['name' => 'John Levine', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/john-levine.jpg'],
            ['name' => 'Michael Samuels', 'role' => 'Services Technician', 'image' => '/site-assets/images/team/michael-samuels.jpg'],
        ],
    ],

    'equipment' => [
        'intro' => [
            'Imaging Services provides CR and DR systems, X-ray solutions, and film processor support for your full imaging workflow.',
            'Computed and Direct Radiography continue to replace film and chemicals as the operational standard for modern clinics.',
            'We support room drawings, installation, removals, relocations, retrofits, and disposal of old equipment.',
        ],
        'categories' => [
            ['name' => 'Chiropractic X-Ray', 'slug' => 'chiropractic-x-ray', 'image' => '/site-assets/images/equipment/category-chiropractic.jpg'],
            ['name' => 'Podiatry X-Ray', 'slug' => 'podiatry-x-ray', 'image' => '/site-assets/images/equipment/category-podiatry.jpg'],
            ['name' => 'Veterinary X-Ray', 'slug' => 'veterinary-x-ray', 'image' => '/site-assets/images/equipment/category-veterinary.jpg'],
            ['name' => 'Mobile X-Ray', 'slug' => 'mobile-x-ray', 'image' => '/site-assets/images/equipment/category-mobile.jpg'],
            ['name' => 'Extentrac Elite M3D', 'slug' => 'extentrac-elite-m3d-device', 'image' => '/site-assets/images/equipment-detail/extentrac.jpg'],
            ['name' => 'SMART-C Portable Mini C-Arm', 'slug' => 'smart-c-portable-mini-c-arm', 'image' => '/site-assets/images/equipment-detail/smart-c.jpg'],
            ['name' => 'Planmed Verity', 'slug' => 'planmed-verity-orthopedic-imaging', 'image' => '/site-assets/images/equipment-detail/planmed-verity.jpg'],
        ],
    ],

    'equipment_details' => [
        'chiropractic-x-ray' => [
            'title' => 'Chiropractic X-Ray Systems',
            'subtitle' => 'Straight-arm and DR-ready configurations for active practices.',
            'image' => '/site-assets/images/equipment/category-chiropractic.jpg',
            'highlights' => [
                'High-frequency generator options with fixed DR flat panel support.',
                'Preset exam protocols and adaptable room-fit layouts.',
                'Integration support with software and PACS workflows.',
            ],
        ],
        'podiatry-x-ray' => [
            'title' => 'Podiatry X-Ray Systems',
            'subtitle' => 'Foot and ankle focused systems for fast diagnostic throughput.',
            'image' => '/site-assets/images/equipment/category-podiatry.jpg',
            'highlights' => [
                'Compact footprint and easy patient positioning.',
                'Optimized exam presets for podiatry workflows.',
                'Digital upgrades available for legacy systems.',
            ],
        ],
        'veterinary-x-ray' => [
            'title' => 'Veterinary X-Ray Systems',
            'subtitle' => 'Durable veterinary imaging with practical handling workflows.',
            'image' => '/site-assets/images/equipment/category-veterinary.jpg',
            'highlights' => [
                'Flexible room setups for companion and mixed animal workflows.',
                'Rapid image capture with DR panel options.',
                'Training included for front office and technical staff.',
            ],
        ],
        'mobile-x-ray' => [
            'title' => 'Mobile X-Ray Systems',
            'subtitle' => 'Portable imaging where care and workflow speed matter most.',
            'image' => '/site-assets/images/equipment/category-mobile.jpg',
            'highlights' => [
                'Mobile solutions for urgent care and high-traffic facilities.',
                'Battery-efficient operation and simple maneuverability.',
                'Remote support and service response planning included.',
            ],
        ],
        'extentrac-elite-m3d-device' => [
            'title' => 'Extentrac Elite M3D Device',
            'subtitle' => 'A specialized orthopedic imaging solution designed for detailed outcomes.',
            'image' => '/site-assets/images/equipment-detail/extentrac.jpg',
            'highlights' => [
                'Precision imaging workflows for orthopedic use cases.',
                'Backed by setup, delivery, and onboarding from Imaging Services.',
                'Accessories and long-term service plans available.',
            ],
            'brochure' => '/site-assets/docs/extentrac-elite-brochure.pdf',
        ],
        'smart-c-portable-mini-c-arm' => [
            'title' => 'SMART-C Portable Mini C-Arm',
            'subtitle' => 'Portable C-arm performance with practical setup and support.',
            'image' => '/site-assets/images/equipment-detail/smart-c.jpg',
            'highlights' => [
                'Compact C-arm workflow for procedure-driven environments.',
                'Field-ready support with responsive service coverage.',
                'Training and post-install optimization included.',
            ],
            'brochure' => '/site-assets/docs/smart-c-brochure.pdf',
        ],
        'planmeca-viso-for-chiropractic' => [
            'title' => 'Planmeca Viso for Chiropractic',
            'subtitle' => 'Advanced imaging designed for chiropractic diagnosis and planning.',
            'image' => '/site-assets/images/equipment/chiropractic.jpg',
            'highlights' => [
                'Built for modern digital workflows and image clarity.',
                'Deployment planning from room layout to final training.',
                'Service and support designed for long-term uptime.',
            ],
        ],
        'planmed-verity-orthopedic-imaging' => [
            'title' => 'Planmed Verity Orthopedic Imaging',
            'subtitle' => 'Orthopedic cone-beam imaging with focused support and implementation.',
            'image' => '/site-assets/images/equipment-detail/planmed-verity.jpg',
            'highlights' => [
                'Detailed orthopedic imaging in compact clinical settings.',
                'Guided implementation from our technical specialists.',
                'Flexible financing and service contract options.',
            ],
        ],
        'orthopedic-urgent-care' => [
            'title' => 'Orthopedic Urgent Care Imaging',
            'subtitle' => 'High-throughput imaging plans built for urgent orthopedic environments.',
            'image' => '/site-assets/images/equipment/veterinary.jpg',
            'highlights' => [
                'Fast room planning and equipment configuration guidance.',
                'Robust service options for demanding patient volume.',
                'Training focused on repeatable, safe imaging workflows.',
            ],
        ],
    ],

    'accessories' => [
        'summary' => 'View and select from our accessories catalog to equip every stage of your imaging workflow.',
        'notes' => [
            'Download the accessories catalog and order form for quick processing.',
            'Send completed order forms by fax or email to our team.',
            'Accessories include positioning aids, markers, protective apparel, MRI/ultrasound supplies, and more.',
        ],
        'catalog_pdf' => '/site-assets/docs/accessories-catalog.pdf',
        'catalog_image' => '/site-assets/images/accessories/grid.jpg',
    ],

    'services' => [
        'intro' => 'Our service engineers keep your imaging operations running with practical support, preventive maintenance, and rapid troubleshooting.',
        'service_options' => [
            'Setup and Configuration',
            'On-Demand Repairs',
            'Equipment Evaluation / Consultation',
            'Equipment Maintenance',
            'Site Planning',
            'Remote Support',
            'Quality Control',
            'Equipment Moves / Delivery',
        ],
        'training_options' => [
            'General Imaging Scenarios',
            'Learn About Equipment Hardware',
            'Understand Accompanying Software',
        ],
        'parts_summary' => 'We provide access to new, refurbished, and used parts for current and prior-generation systems.',
        'brands' => ['20/20 Imaging', 'AGFA', 'Americomp', 'Amrad Medical', 'Del Medical', 'FUJI', 'InnoVet', 'Konica Minolta'],
    ],

    'payments' => [
        'mailing' => [
            'company' => 'Imaging Services, Inc.',
            'address' => '1260 Woodland Ave, Unit 17B, Springfield, PA 19064',
        ],
        'bank_transfer' => [
            'title' => 'For Bank Transfers',
            'note' => 'Contact our team for secure transfer instructions and remittance confirmation.',
        ],
        'card_note' => 'We accept all major credit cards. Payment details are handled securely and are not stored unless authorized.',
    ],

    'contact' => [
        'headline' => 'Contact us for any questions',
        'subhead' => 'Call or visit us for sales, service, and accessories support.',
        'principals' => [
            ['name' => 'Jim Kreiger', 'phone' => '+1 (410) 513-6840'],
            ['name' => 'Michael Tokash', 'phone' => '+1 (610) 812-3079'],
        ],
        'locations' => [
            'PA' => '1260 Woodland Ave, Unit 17B, Springfield, PA 19064',
            'MD' => '9603 Amberleigh Ln, Perry Hall, MD 21128',
            'CT' => '31 Killingworth Turnpike, Clinton, CT 06413',
            'FL' => '1111 Arrowhead Point Road, Loxahatchee, FL 33470',
        ],
    ],

    'privacy' => [
        'effective_date' => 'February 25, 2022',
        'summary' => 'Imaging Services respects your privacy and uses personal information only to provide requested products and services and related support.',
        'sections' => [
            [
                'title' => 'Information Collection and Use',
                'body' => [
                    'We collect contact and business details needed to respond to inquiries and deliver requested services.',
                    'You may opt in or opt out of additional updates by email, phone, or SMS.',
                    'We use reasonable safeguards to protect personal information.',
                ],
            ],
            [
                'title' => 'Technical and Cookie Data',
                'body' => [
                    'The site may use cookies and essential technical data (such as IP address) to deliver website functionality.',
                    'You can disable cookies in your browser, though some features may not function as expected.',
                ],
            ],
            [
                'title' => 'Terms of Service',
                'body' => [
                    'Using the website indicates acceptance of current terms and conditions.',
                    'Content is provided for general information and may change without notice.',
                    'External links are provided for convenience and may have separate terms and policies.',
                ],
            ],
        ],
    ],

    'marketing_pages' => [
        'used-equipment' => [
            'title' => 'Used Equipment',
            'description' => 'Quality evaluated imaging systems and upgrade paths for budget-conscious practices.',
            'body' => [
                'Our used equipment pipeline includes thoroughly reviewed systems and practical upgrade options for clinics ready to modernize.',
                'Tell us your workflow and budget goals. We can match systems, accessories, and service coverage to your current stage of growth.',
            ],
            'cta' => ['label' => 'Request Availability', 'route' => 'contact'],
        ],
        'october-2024-message' => [
            'title' => 'October 2024 Message',
            'description' => 'Company updates and seasonal guidance from the Imaging Services team.',
            'body' => [
                'Thank you for trusting our team through another year of growth and equipment modernization projects.',
                'If you are planning upgrades before year-end, contact us early so we can plan ordering, delivery, and installation windows.',
            ],
            'cta' => ['label' => 'Talk to Our Team', 'route' => 'contact'],
        ],
        'promo-eq-summer-24' => [
            'title' => 'Summer 2024 Equipment Promotion',
            'description' => 'Promotional equipment bundles and support options from Imaging Services.',
            'body' => [
                'Our seasonal promotions focus on high-value systems paired with dependable service and training coverage.',
                'Reach out for current package availability, financing options, and installation planning.',
            ],
            'cta' => ['label' => 'Get Promo Details', 'route' => 'contact'],
        ],
        'careers' => [
            'title' => 'Careers',
            'description' => 'Join the Imaging Services team in sales, technical support, and operations.',
            'body' => [
                'We are always interested in experienced, service-minded professionals who care about customer outcomes.',
                'If you are interested in sales, technical service, or operational roles, send your background and location preferences to our team.',
            ],
            'cta' => ['label' => 'Contact Careers Team', 'route' => 'contact'],
        ],
        'refund_returns' => [
            'title' => 'Refund and Returns',
            'description' => 'General policy guidance for returns, cancellations, and processing timelines.',
            'body' => [
                'Refund and return eligibility depends on product category, condition, and order status at time of request.',
                'Contact us with your invoice details so we can review next steps and provide the fastest path to resolution.',
            ],
            'cta' => ['label' => 'Request Assistance', 'route' => 'contact'],
        ],
        'shop' => [
            'title' => 'Shop',
            'description' => 'Product catalog and ordering support for imaging equipment and accessories.',
            'body' => [
                'Our online shop experience is being refreshed. You can still place accessory and equipment requests directly with our team.',
                'For immediate ordering support, reach out by phone or submit a contact request and we will assist quickly.',
            ],
            'cta' => ['label' => 'Order Accessories', 'route' => 'accessories'],
        ],
        'compare' => [
            'title' => 'Compare Products',
            'description' => 'Compare imaging systems with help from our specialists.',
            'body' => [
                'Share your workflow priorities and we will help you compare equipment options by throughput, footprint, and budget.',
                'Our sales and technical teams can provide practical recommendations tailored to your facility.',
            ],
            'cta' => ['label' => 'Start a Comparison', 'route' => 'contact'],
        ],
        'wishlist' => [
            'title' => 'Wishlist',
            'description' => 'Save equipment interests and coordinate next steps with Imaging Services.',
            'body' => [
                'Use this page as a planning checkpoint while we finalize online wishlist tools for customers.',
                'If you already know what you need, send us your list and we will prepare a matched recommendation.',
            ],
            'cta' => ['label' => 'Send Your Wishlist', 'route' => 'contact'],
        ],
        'maintenance-page' => [
            'title' => 'Maintenance Update',
            'description' => 'This section is currently receiving updates from the Imaging Services team.',
            'body' => [
                'We are actively updating this section to improve product detail, media resources, and support workflows.',
                'For urgent equipment or service questions, contact us directly and we will respond promptly.',
            ],
            'cta' => ['label' => 'Contact Support', 'route' => 'contact'],
        ],
    ],

    'blog_posts' => [
        'are-you-an-active-participant-in-your-growth' => [
            'title' => 'Are You an Active Participant in Your Growth?',
            'published' => 'Media Archive',
            'summary' => 'A practical reminder that growth in imaging operations is intentional, measurable, and driven by consistent actions.',
            'content' => [
                'Sustainable growth rarely happens by accident. Teams that review workflow data, upgrade strategically, and train continuously are better positioned for long-term performance.',
                'If you are evaluating your next step, start with service reliability, imaging quality, and staff confidence. Small operational wins compound quickly.',
            ],
        ],
        'chiropractic-rocks-2019-interview-with-jim-chester' => [
            'title' => 'Chiropractic Rocks 2019: Interview with Jim Chester',
            'published' => 'Media Archive',
            'summary' => 'Highlights from a conversation on service culture, equipment reliability, and supporting chiropractic practices.',
            'content' => [
                'The interview focuses on practical support principles: stay accessible, follow through after installation, and keep technical guidance simple and repeatable.',
                'Long-term relationships in imaging are earned through consistent response times and clear communication during every support interaction.',
            ],
        ],
        'the-chiropractic-compass-podcast-interview-19' => [
            'title' => 'The Chiropractic Compass Podcast Interview #19',
            'published' => 'Media Archive',
            'summary' => 'A discussion about imaging business fundamentals, operational readiness, and customer-first service.',
            'content' => [
                'The episode emphasizes preparedness: right-sized systems, documented workflows, and clear expectations for training and support.',
                'Practices that align equipment decisions with patient throughput goals tend to see the most consistent return on investment.',
            ],
        ],
        'celebrating-45-years-of-services-in-digiting-imaging' => [
            'title' => 'Celebrating 45 Years of Service in Digital Imaging',
            'published' => 'Media Archive',
            'summary' => 'A milestone reflection on decades of support across equipment sales, implementation, and technical service.',
            'content' => [
                'Serving healthcare practices over multiple decades requires adapting to technology shifts while keeping service standards high.',
                'Our focus remains the same: dependable recommendations, clear implementation plans, and support that keeps clinics moving.',
            ],
        ],
        'the-hidden-costs-of-outdated-x-ray-processors-is-it-time-to-upgrade' => [
            'title' => 'The Hidden Costs of Outdated X-Ray Processors: Is It Time to Upgrade?',
            'published' => 'Recent Article',
            'summary' => 'How older processing workflows create avoidable costs in service time, consumables, and diagnostic delays.',
            'content' => [
                'Legacy processors often introduce recurring cost centers that are hard to see in isolation: chemistry, downtime, repeat shots, and slower handoffs.',
                'A thoughtful digital upgrade can reduce variability, improve turnaround, and give teams a cleaner baseline for performance management.',
            ],
        ],
        'why-your-x-ray-processor-is-holding-you-back-5-signs-its-time-for-a-change' => [
            'title' => 'Why Your X-Ray Processor Is Holding You Back: 5 Signs It Is Time for a Change',
            'published' => 'Recent Article',
            'summary' => 'Five practical indicators that legacy processing is reducing productivity and patient flow.',
            'content' => [
                'Common warning signs include escalating service incidents, inconsistent image output, staff workarounds, and prolonged exam cycles.',
                'When these patterns persist, replacement planning can be more cost-effective than repeated patchwork fixes.',
            ],
        ],
        'beyond-the-basics-how-to-maximize-the-roi-of-your-digital-x-ray-equipment' => [
            'title' => 'Beyond the Basics: How to Maximize ROI of Your Digital X-Ray Equipment',
            'published' => 'Recent Article',
            'summary' => 'ROI improves when hardware investment is paired with repeatable training and operational discipline.',
            'content' => [
                'High-value equipment performs best when teams standardize positioning, optimize presets, and track repeat-rate metrics over time.',
                'Operational maturity comes from combining technical support with practical habits that keep quality and speed aligned.',
            ],
        ],
        'the-future-of-digital-x-ray-5-game-changing-innovations-to-watch' => [
            'title' => 'The Future of Digital X-Ray: 5 Innovations to Watch',
            'published' => 'Recent Article',
            'summary' => 'A forward look at technology trends affecting image quality, workflow speed, and maintenance models.',
            'content' => [
                'Emerging capabilities in software, image processing, and remote diagnostics continue to change how clinics manage throughput and support.',
                'Choosing adaptable platforms now helps protect your investment as standards and expectations evolve.',
            ],
        ],
        'reducing-radiation-exposure-how-modern-digital-x-ray-systems-are-making-imaging-safer' => [
            'title' => 'Reducing Radiation Exposure: How Modern Digital X-Ray Systems Are Improving Safety',
            'published' => 'Recent Article',
            'summary' => 'Modern systems pair dose-conscious workflows with image clarity and practical operator controls.',
            'content' => [
                'Digital workflows enable better consistency, reducing repeat imaging and supporting safer exam execution across teams.',
                'Safety outcomes improve when equipment setup, preset governance, and operator training are managed together.',
            ],
        ],
        'the-economics-of-digital-x-ray-is-it-actually-saving-you-money' => [
            'title' => 'The Economics of Digital X-Ray: Is It Actually Saving You Money?',
            'published' => 'Recent Article',
            'summary' => 'A business view of digital imaging costs, operational benefits, and long-term value creation.',
            'content' => [
                'Digital adoption typically shifts spending from consumables and process friction into predictable service and lifecycle planning.',
                'The strongest outcomes come from clear implementation plans, real training time, and accountability around workflow metrics.',
            ],
        ],
    ],
];
