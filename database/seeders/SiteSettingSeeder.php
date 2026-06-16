<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'logo' => 'assets/images/logo/lsp1.png',
            'footer_text' => '© ' . date('Y') . ' LSP. All rights reserved.',
            'title' => 'LSP',
            'favicon' => 'assets/images/favicon.ico',
            'header_image' => 'assets/images/head1.jpg',
            'maps_embed' => 'https://maps.app.goo.gl/BTmm5edM9ihuhYNW9',
            'phone' => '+62 8xx xxxx xxxx',
            'address' => 'Alamat LSP',
            'instagram' => '#',
            'facebook' => '#',
            'twitter' => '#',
            'email' => 'info@lsp.com',
            'primary_color' => '#563fbb',
            'secondary_color' => '#563fbb',
        ];

        $setting = SiteSetting::first();
        if ($setting) {
            $setting->update($data);
        } else {
            SiteSetting::create($data);
        }
    }
}
