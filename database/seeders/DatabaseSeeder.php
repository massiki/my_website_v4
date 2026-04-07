<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\Education;
use App\Models\Experience;
use App\Models\HomeContent;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // ── Home Content ────────────────────────────────
        $homeData = [
            ['key' => 'hero_name',     'value' => 'John Doe'],
            ['key' => 'hero_title',    'value' => 'Fullstack Developer'],
            ['key' => 'hero_bio',      'value' => 'Passionate developer crafting beautiful web experiences with modern technologies. I turn ideas into elegant, functional digital solutions.'],
            ['key' => 'hero_cta_1',    'value' => 'View Projects'],
            ['key' => 'hero_cta_1_url', 'value' => '/projects'],
            ['key' => 'hero_cta_2',    'value' => 'Contact Me'],
            ['key' => 'hero_cta_2_url', 'value' => '/contact'],
            ['key' => 'about_bio',     'value' => 'I am a fullstack developer with 5+ years of experience building web applications. I specialize in Laravel, Vue.js, and modern web technologies. I am passionate about clean code, user experience, and creating software that makes a difference.'],
        ];
        foreach ($homeData as $item) {
            HomeContent::create($item);
        }

        // ── Services ────────────────────────────────────
        $services = [
            [
                'icon'         => 'code',
                'title'        => 'Web Development',
                'description'  => 'Building modern, responsive web applications using the latest technologies and best practices.',
                'technologies' => ['Laravel', 'Vue.js', 'React', 'TailwindCSS'],
                'sort_order'   => 1,
            ],
            [
                'icon'         => 'smartphone',
                'title'        => 'Mobile Development',
                'description'  => 'Creating cross-platform mobile applications that provide native-like experiences.',
                'technologies' => ['Flutter', 'React Native', 'Dart'],
                'sort_order'   => 2,
            ],
            [
                'icon'         => 'server',
                'title'        => 'API Development',
                'description'  => 'Designing and building RESTful APIs that are scalable, secure, and well-documented.',
                'technologies' => ['Laravel', 'Node.js', 'PostgreSQL', 'Redis'],
                'sort_order'   => 3,
            ],
            [
                'icon'         => 'palette',
                'title'        => 'UI/UX Design',
                'description'  => 'Crafting intuitive and visually appealing user interfaces with attention to detail.',
                'technologies' => ['Figma', 'TailwindCSS', 'CSS3', 'Adobe XD'],
                'sort_order'   => 4,
            ],
        ];
        foreach ($services as $service) {
            Service::create($service);
        }

        // ── Categories ──────────────────────────────────
        $categories = ['Backend', 'Frontend', 'Fullstack', 'AI / ML', 'Mobile'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'slug' => Str::slug($cat)]);
        }

        // ── Technologies ────────────────────────────────
        $techs = [
            'Laravel',
            'PHP',
            'Vue.js',
            'React',
            'TailwindCSS',
            'MySQL',
            'PostgreSQL',
            'Node.js',
            'TypeScript',
            'Python',
            'Docker',
            'Redis',
            'Flutter',
            'Git',
            'Bootstrap'
        ];
        $techModels = [];
        foreach ($techs as $t) {
            $techModels[$t] = Technology::create(['name' => $t, 'slug' => Str::slug($t)]);
        }

        // ── Projects ────────────────────────────────────
        $projects = [
            [
                'category'          => 'Fullstack',
                'title'             => 'E-Commerce Platform',
                'short_description' => 'A full-featured e-commerce application with payment integration and admin dashboard.',
                'description'       => 'Built a comprehensive e-commerce platform featuring product management, shopping cart, checkout with Midtrans payment gateway, order tracking, and a complete admin panel for managing products, orders, and customers.',
                'demo_url'          => 'https://demo.example.com',
                'github_url'        => 'https://github.com/johndoe/ecommerce',
                'is_featured'       => true,
                'techs'             => ['Laravel', 'Vue.js', 'TailwindCSS', 'MySQL'],
            ],
            [
                'category'          => 'Frontend',
                'title'             => 'Dashboard Analytics',
                'short_description' => 'Interactive analytics dashboard with real-time data visualization and reporting.',
                'description'       => 'Designed and developed a modern analytics dashboard with interactive charts, real-time data updates, export functionality, and responsive design for monitoring business metrics.',
                'demo_url'          => 'https://dashboard.example.com',
                'github_url'        => 'https://github.com/johndoe/dashboard',
                'is_featured'       => true,
                'techs'             => ['React', 'TypeScript', 'TailwindCSS'],
            ],
            [
                'category'          => 'Backend',
                'title'             => 'REST API Microservice',
                'short_description' => 'Scalable microservice architecture with authentication and rate limiting.',
                'description'       => 'Engineered a high-performance REST API microservice with JWT authentication, rate limiting, caching, comprehensive documentation, and automated testing.',
                'demo_url'          => null,
                'github_url'        => 'https://github.com/johndoe/api-service',
                'is_featured'       => true,
                'techs'             => ['Laravel', 'PHP', 'Redis', 'PostgreSQL', 'Docker'],
            ],
            [
                'category'          => 'AI / ML',
                'title'             => 'AI Chatbot Assistant',
                'short_description' => 'Intelligent chatbot using NLP for customer support automation.',
                'description'       => 'Developed an AI-powered chatbot that handles customer inquiries using natural language processing, with context-aware responses and seamless human handoff capabilities.',
                'demo_url'          => 'https://chatbot.example.com',
                'github_url'        => 'https://github.com/johndoe/chatbot',
                'is_featured'       => false,
                'techs'             => ['Python', 'Node.js'],
            ],
            [
                'category'          => 'Mobile',
                'title'             => 'Fitness Tracker App',
                'short_description' => 'Cross-platform fitness tracking app with workout plans and progress monitoring.',
                'description'       => 'Created a comprehensive fitness tracking application with custom workout plans, progress charts, social features, and integration with health APIs.',
                'demo_url'          => null,
                'github_url'        => 'https://github.com/johndoe/fitness-app',
                'is_featured'       => false,
                'techs'             => ['Flutter', 'Laravel', 'MySQL'],
            ],
            [
                'category'          => 'Fullstack',
                'title'             => 'Project Management Tool',
                'short_description' => 'Collaborative project management tool with real-time updates and team features.',
                'description'       => 'Built a Trello-inspired project management tool with drag-and-drop boards, real-time collaboration, file attachments, team management, and activity logging.',
                'demo_url'          => 'https://pm.example.com',
                'github_url'        => 'https://github.com/johndoe/pm-tool',
                'is_featured'       => false,
                'techs'             => ['Laravel', 'Vue.js', 'MySQL', 'Redis'],
            ],
        ];

        foreach ($projects as $i => $p) {
            $cat = Category::where('slug', Str::slug($p['category']))->first();
            $project = Project::create([
                'category_id'       => $cat->id,
                'title'             => $p['title'],
                'slug'              => Str::slug($p['title']),
                'short_description' => $p['short_description'],
                'description'       => $p['description'],
                'demo_url'          => $p['demo_url'],
                'github_url'        => $p['github_url'],
                'is_featured'       => $p['is_featured'],
                'sort_order'        => $i + 1,
            ]);
            $techIds = collect($p['techs'])->map(fn($t) => $techModels[$t]->id)->toArray();
            $project->technologies()->attach($techIds);
        }

        // ── Experiences ─────────────────────────────────
        $experiences = [
            [
                'company'    => 'Tech Corp Inc.',
                'position'   => 'Senior Fullstack Developer',
                'description' => 'Led development of enterprise web applications, mentored junior developers, and implemented CI/CD pipelines.',
                'start_date' => '2022-01-01',
                'end_date'   => null,
                'sort_order'  => 1,
            ],
            [
                'company'    => 'Digital Agency',
                'position'   => 'Web Developer',
                'description' => 'Built client websites and web applications using Laravel and Vue.js. Managed project timelines and client communications.',
                'start_date' => '2020-03-01',
                'end_date'   => '2021-12-31',
                'sort_order'  => 2,
            ],
            [
                'company'    => 'Startup Studio',
                'position'   => 'Junior Developer',
                'description' => 'Developed features for SaaS products, wrote unit tests, and participated in code reviews.',
                'start_date' => '2019-01-01',
                'end_date'   => '2020-02-28',
                'sort_order'  => 3,
            ],
        ];
        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // ── Educations ──────────────────────────────────
        Education::create([
            'institution'    => 'University of Technology',
            'degree'         => 'Bachelor of Science',
            'field_of_study' => 'Computer Science',
            'start_year'     => '2015',
            'end_year'       => '2019',
            'sort_order'     => 1,
        ]);
        Education::create([
            'institution'    => 'Online Academy',
            'degree'         => 'Professional Certificate',
            'field_of_study' => 'Fullstack Web Development',
            'start_year'     => '2019',
            'end_year'       => '2020',
            'sort_order'     => 2,
        ]);

        // ── Skills ──────────────────────────────────────
        $skills = [
            ['name' => 'Laravel',     'category' => 'Backend',  'level' => 95],
            ['name' => 'PHP',         'category' => 'Backend',  'level' => 90],
            ['name' => 'MySQL',       'category' => 'Backend',  'level' => 85],
            ['name' => 'Node.js',     'category' => 'Backend',  'level' => 75],
            ['name' => 'Vue.js',      'category' => 'Frontend', 'level' => 88],
            ['name' => 'React',       'category' => 'Frontend', 'level' => 80],
            ['name' => 'TailwindCSS', 'category' => 'Frontend', 'level' => 92],
            ['name' => 'JavaScript',  'category' => 'Frontend', 'level' => 88],
            ['name' => 'TypeScript',  'category' => 'Frontend', 'level' => 78],
            ['name' => 'Git',         'category' => 'Tools',    'level' => 90],
            ['name' => 'Docker',      'category' => 'Tools',    'level' => 75],
            ['name' => 'Figma',       'category' => 'Tools',    'level' => 70],
            ['name' => 'VS Code',     'category' => 'Tools',    'level' => 95],
            ['name' => 'Linux',       'category' => 'Tools',    'level' => 80],
        ];
        foreach ($skills as $i => $s) {
            Skill::create(array_merge($s, ['sort_order' => $i + 1]));
        }

        // ── Contact Info ────────────────────────────────
        $contacts = [
            ['key' => 'email',     'value' => 'john@example.com'],
            ['key' => 'whatsapp',  'value' => '+6281234567890'],
            ['key' => 'github',    'value' => 'https://github.com/johndoe'],
            ['key' => 'linkedin',  'value' => 'https://linkedin.com/in/johndoe'],
            ['key' => 'twitter',   'value' => 'https://twitter.com/johndoe'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/johndoe'],
        ];
        foreach ($contacts as $c) {
            ContactInfo::create($c);
        }

        // ── Sample Messages ─────────────────────────────
        Message::create([
            'name'    => 'Jane Smith',
            'email'   => 'jane@example.com',
            'subject' => 'Project Inquiry',
            'message' => 'Hi, I am interested in hiring you for a web development project. Could we schedule a call?',
            'is_read' => false,
        ]);
        Message::create([
            'name'    => 'Bob Johnson',
            'email'   => 'bob@example.com',
            'subject' => 'Collaboration Opportunity',
            'message' => 'Hey! I saw your portfolio and would love to discuss a potential collaboration on an open-source project.',
            'is_read' => true,
        ]);
    }
}
