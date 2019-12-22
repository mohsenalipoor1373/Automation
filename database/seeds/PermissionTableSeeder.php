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
            'درخواستهای مساعده-سرپرست',
            'درخواستهای مرخصی-سرپرست',
            'درخواست های خرید کالا-سرپرست',
            'درخواستهای کسر کار-سرپرست',
            'درخواست های ماموریت-سرپرست',
            'درخواستهای مرخصی-مدیریت',
            'درخواستهای کسر کار-مدیریت',
            'درخواستهای مساعده-مدیریت',
            'درخواستهای اضافه کار-مدیریت',
            'درخواست های ماموریت-مدیریت',
            'درخواست های خرید کالا-مدیریت',
            'مساعده',
            'بخش',
            'پرسنل',
            'مرخصی',
            'کسر کار',
            'اضافه کار',
            'ماموریت',
            'خرید کالا',

        ];


        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
