<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\CommonMark\Node\Block\Document;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	    $this->call([
		    AccessLevelSeeder::class,
            FieldTypeSeeder::class,
		    ModuleSeeder::class,
		    PrivilegeSeeder::class,
		    RoleSeeder::class,
		    RolePrivilegeSeeder::class,
            UserTypeSeeder::class,
            DepartmentSeeder::class,
            BranchSeeder::class,
		    UserSeeder::class,
		    UserRoleSeeder::class,
            SettingTypeSeeder::class,
            SettingSeeder::class,
            FilesSeeder::class,
            DocumentTypeSeeder::class,
            DocumentSeeder::class,
            RemarkSeeder::class,
            AttachmentSeeder::class,
            RecipientSeeder::class,
	    ]);
    }
}
