<div class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
             data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">

            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                 id="#kt_aside_menu" data-kt-menu="true">

                <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                    <div class="symbol symbol-50px">
                        <img src="{{ asset('admin/media/avatars/300-1.jpg') }}" alt="" />
                    </div>
                    <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ auth()->user()->name }}</a>
                                <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ auth()->user()->email }}</span>
                                <div class="d-flex align-items-center text-success fs-9">
                                    <span class="bullet bullet-dot bg-success me-1"></span>online
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'home' ? 'active' : '' }}" href="{{ route('admin.home') }}">
                       <span class="menu-icon">
                           <span class="svg-icon svg-icon-2">
                               <i class="fas fa-home"></i>
                           </span>
                       </span>
                        <span class="menu-title">{{ __('admin.menu.home') }}</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'admins' ? 'active' : '' }}" href="{{ route('admin.admins.index')}}">
                       <span class="menu-icon">
                           <span class="svg-icon svg-icon-2">
                               <i class="fas fa-user-shield"></i>
                           </span>
                       </span>
                        <span class="menu-title">المشرفين</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'house_owners' ? 'active' : '' }}" href="{{ route('admin.house_owners.index')}}">
                       <span class="menu-icon">
                           <span class="svg-icon svg-icon-2">
                               <i class="fas fa-house-user"></i>
                           </span>
                       </span>
                        <span class="menu-title">ملاك البيوت</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'business_owners' ? 'active' : '' }}" href="{{ route('admin.business_owners.index')}}">
                       <span class="menu-icon">
                           <span class="svg-icon svg-icon-2">
                               <i class="fas fa-briefcase"></i>
                           </span>
                       </span>
                        <span class="menu-title">ملاك الأعمال</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'email' ? 'active' : '' }}" href="{{ route('admin.email.index') }}">
       <span class="menu-icon">
           <span class="svg-icon svg-icon-2">
               <i class="fas fa-envelope"></i>
           </span>
       </span>
                        <span class="menu-title">إرسال رسالة</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'faqs' ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
        <span class="menu-icon">
            <span class="svg-icon svg-icon-2">
                <i class="fas fa-question-circle"></i>
            </span>
        </span>
                        <span class="menu-title">الأسئلة الشائعة</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ $is_active == 'settings' ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
       <span class="menu-icon">
           <span class="svg-icon svg-icon-2">
               <i class="fas fa-cog"></i>
           </span>
       </span>
                        <span class="menu-title">الإعدادات</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>