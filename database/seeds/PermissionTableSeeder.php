<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'مساعده-سرپرست',
            'مرخصی-سرپرست',
            'خرید کالا-سرپرست',
            'کسر کار-سرپرست',
            'ماموریت-سرپرست',
            'درخواستهای تور قفس',
            'درخواستهای تور صیدماهی',
            'مرخصی-مدیریت',
            'کسر کار-مدیریت',
            'مساعده-مدیریت',
            'اضافه کار-مدیریت',
            'ماموریت-مدیریت',
            'خرید کالا-مدیریت',
            'مساعده',
            'بخش',
            'پرسنل',
            'مرخصی',
            'کسر کار',
            'اضافه کار',
            'ماموریت',
            'خرید کالا',
            'تور قفس',
            'تور صیدماهی',


        ];


        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
