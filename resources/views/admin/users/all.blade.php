@component('admin.layouts.content' , ['title' => 'لیست کاربران'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">لیست کاربران</li>
    @endslot

    <h2>User Panel</h2>

@endcomponent
