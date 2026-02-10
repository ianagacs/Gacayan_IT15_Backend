<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600" rel="stylesheet" />
    <style>
        :root {
            --bg: #f7f3ee;
            --ink: #1f1c17;
            --muted: #6b645a;
            --card: #ffffff;
            --accent: #c46a2b;
            --border: #e4dbd2;
            --shadow: 0 10px 25px rgba(31, 28, 23, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Space Grotesk", sans-serif;
            background: radial-gradient(circle at top left, #fbf8f3 0%, var(--bg) 45%),
                linear-gradient(120deg, #f1e9e1 0%, #f7f3ee 55%, #f0e4d6 100%);
            color: var(--ink);
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 24px;
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .categories {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .category-link {
            display: block;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--ink);
            text-decoration: none;
            border: 1px solid transparent;
            background: transparent;
            transition: border 0.2s ease, background 0.2s ease, color 0.2s ease;
        }

        .category-link:hover {
            border-color: var(--border);
            background: #f4eee7;
        }

        .category-link.active {
            border-color: var(--accent);
            background: #fff2e7;
            color: var(--accent);
            font-weight: 600;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            background: var(--card);
            box-shadow: var(--shadow);
        }

        .card h3 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.5;
        }

        .card .meta {
            display: inline-block;
            margin-bottom: 10px;
            font-size: 12px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .empty {
            color: var(--muted);
            font-size: 14px;
        }

        @media (max-width: 820px) {
            .layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="title">Simple Posts Board</div>
        <div class="layout">
            <aside class="panel">
                <div class="categories">
                    @forelse ($categories as $category)
                        <a
                            class="category-link {{ (string) $activeCategoryId === (string) $category->id ? 'active' : '' }}"
                            href="{{ url('/?category=' . $category->id) }}"
                        >
                            {{ $category->name }}
                        </a>
                    @empty
                        <div class="empty">No categories yet.</div>
                    @endforelse
                </div>
            </aside>

            <section class="panel">
                <div class="cards">
                    @forelse ($posts as $post)
                        <article class="card">
                            <span class="meta">{{ $post->category?->name }}</span>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->description }}</p>
                        </article>
                    @empty
                        <div class="empty">No posts found for this category.</div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</body>
</html>
