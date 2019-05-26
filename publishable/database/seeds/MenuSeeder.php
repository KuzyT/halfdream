<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Menu seeding...");

        $arr = [
            [
                'key' => 'main',
                'title' => 'Main menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'route' => 'index',
                        'visible' => true,
                        'order' => 1,
                        'icon_id' => ($icon = icon('fas.home')) ? $icon->id : null,
                        'color' => '#C9E3C8'
                    ],
                    [
                        'title' => 'Blog',
                        'route' => 'post.index',
                        'visible' => true,
                        'order' => 2,
                        'icon_id' => ($icon = icon('fas.rss')) ? $icon->id : null,
                        'color' => '#f26522'
                    ],
                    [
                        'title' => 'Categories',
                        'route' => 'category.index',
                        'visible' => true,
                        'order' => 3,
                        'icon_id' => ($icon = icon('fas.folder-open')) ? $icon->id : null,
                        'color' => '#5F4138'
                    ],
                ]
            ],
            [
                'key' => 'footer',
                'title' => 'Footer menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'route' => 'index',
                        'visible' => true,
                        'order' => 1,
                        'icon_id' => ($icon = icon('fas.home')) ? $icon->id : null,
                        'color' => '#C9E3C8'
                    ],
                    [
                        'title' => 'Blog',
                        'route' => 'post.index',
                        'visible' => true,
                        'order' => 2,
                        'icon_id' => ($icon = icon('fas.rss')) ? $icon->id : null,
                        'color' => '#f26522'
                    ],
                    [
                        'title' => 'Categories',
                        'route' => 'category.index',
                        'visible' => true,
                        'order' => 3,
                        'icon_id' => ($icon = icon('fas.folder-open')) ? $icon->id : null,
                        'color' => '#5F4138'
                    ],
                ]
            ],
            [
                'key' => 'social',
                'title' => 'Social menu',
                'items' => [
                    [
                        'title' => 'HalfDream',
                        'url' => 'https://www.halfdream.ru/',
                        'target' => \KuzyT\Halfdream\Models\MenuItem::TARGET_BLANK,
                        'visible' => true,
                        'order' => 1,
                        'icon_id' => ($icon = icon('svg.halfdream')) ? $icon->id : null,
                        'class' => 'halfdream-icon'
                    ],
                    [
                        'title' => 'GitHub',
                        'url' => 'https://github.com/KuzyT/halfdream',
                        'target' => \KuzyT\Halfdream\Models\MenuItem::TARGET_BLANK,
                        'visible' => true,
                        'order' => 2,
                        'icon_id' => ($icon = icon('fab.github')) ? $icon->id : null,
                        'color' => '#363636'
                    ],
                    [
                        'title' => 'Vk',
                        'url' => 'https://vk.com/halfdream',
                        'target' => \KuzyT\Halfdream\Models\MenuItem::TARGET_BLANK,
                        'visible' => true,
                        'order' => 3,
                        'icon_id' => ($icon = icon('fab.vk')) ? $icon->id : null,
                        'color' => '#4d7198'
                    ],
                    [
                        'title' => 'Patreon',
                        'url' => 'https://www.patreon.com/kuzyt',
                        'target' => \KuzyT\Halfdream\Models\MenuItem::TARGET_BLANK,
                        'visible' => true,
                        'order' => 3,
                        'icon_id' => ($icon = icon('fab.patreon')) ? $icon->id : null,
                        'color' => 'rgb(232, 91, 70)'
                    ],
                ]
            ],
        ];

        foreach ($arr as $elem) {
            if (!\KuzyT\Halfdream\Models\Menu::where('key', $key = $elem['key'])->first()) {
                $this->command->line("Adding menu with key '<info>$key</info>'...");
                $children = [];

                $this->prepareSeedArray($elem, $children);
                $menu = \KuzyT\Halfdream\Models\Menu::create($elem);

                $menu->items()->createMany($children);
            }
        }
    }

    // If needed, can be moved to Halfdream helper
    protected function prepareSeedArray(&$seedArray, &$children = null, $childrenField = 'items') {
        // Items are for inner
        if (key_exists($childrenField, $seedArray)) {
            $children = $seedArray[$childrenField];
            unset($seedArray[$childrenField]);
        }
    }
}
