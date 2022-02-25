<?php

namespace Database\Seeders;

use App\Models\Master\Organization;
use App\Models\Master\OrganizationLanguage;
use App\Models\Master\Phrase\Phrase;
use App\Models\Master\Phrase\PhraseTranslation;
use App\Models\Organization\Basic\Phrase\Phrase as OrganizationPhrases;
use App\Models\Organization\Basic\Phrase\PhraseTranslation as OrganizationPhraseTranslation;
use App\Models\Master\UserOrganization;
use App\Models\User;
use App\Services\Master\User\UserService;
use App\Services\Organization\Basic\Employee\EmployeeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Services\RandomGenerationService;

class UserSeeder extends Seeder
{
    protected RandomGenerationService $randomGenerationService;
    protected UserService $userService;
    protected EmployeeService $employeeService;

    public function __construct(
        RandomGenerationService $randomGenerationService,
        UserService             $userService,
        EmployeeService         $employeeService
    )
    {
        $this->randomGenerationService = $randomGenerationService;
        $this->userService = $userService;
        $this->employeeService = $employeeService;
    }

    public function run()
    {
        $token = $this->randomGenerationService->string(100);
        $password = bcrypt('byork!@#$%');
        $remember_token = Str::random(50);
        DB::unprepared("insert into users (username,name, password,remember_token, verification_token)
            values ('superadmin@byorkit.uz', 'Пользователь','$password', '$remember_token', '$token')");
        $user = $this->userService->get()->where('verification_token', $token)->first();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $default_database = env('DB_PREFIX') . '_' . substr(str_shuffle($permitted_chars), 0, 8);
        $email_verified_at = now();
        DB::unprepared("update users set default_database = '$default_database', email_verified_at = '$email_verified_at' where id = '$user->id'");
        $this->userService->seeder($default_database);
        $organization = Organization::create([
            'name' => $default_database,
            'db_name' => $default_database,
            'host_name' => $default_database,
        ]);

        UserOrganization::create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
        ]);

        OrganizationLanguage::create([
            'organization_id' => $organization->id,
            'language_id' => 1,
            'is_default' => true,
        ]);
        $data = [
            'user_id' => $user->id,
            'email' => $user->username
        ];
        $this->employeeService->store($data);


        $phrases = Phrase::all();
        $phrase_translations = PhraseTranslation::all();

        foreach ($phrases as $phrase) {
            OrganizationPhrases::create($phrase->toArray());
        }
        foreach ($phrase_translations as $phrase_translation) {
            OrganizationPhraseTranslation::create($phrase_translation->toArray());
        }

        DB::connection('byorkit_organization')->select("SELECT setval('phrases_id_seq', max(id)) FROM public.phrases");
        DB::connection('byorkit_organization')->select("SELECT setval('phrase_translations_id_seq', max(id)) FROM public.phrase_translations");

        User::factory()->count(5)->create();

    }
}
