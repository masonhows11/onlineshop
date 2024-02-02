@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $user =  auth()->user();
@endphp
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="#">
            {{--            <img alt="Logo" src="{{ asset('dash/logos/logo-1.svg') }}" class="h-15px logo"/> --}}
            {{ __('messages.site_name') }}
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.5"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
                    </g>
                </svg>
            </span>
        </div>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="0">
            <div
                class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link {{ $route === 'admin.dashboard' ? 'active' : '' }} "
                       href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                     viewBox="0 0 24 24" version="1.1">
                                    <path
                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                        fill="#000000" opacity="0.3"/>
                                    <path
                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                        fill="#000000"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">{{ __('messages.admin_dashboard') }}</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('home') }}" target="_blank">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                     viewBox="0 0 24 24" version="1.1">
                                    <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8"/>
                                    <polygon fill="#000000" points="23 8 12 20 1 8"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">{{ __('messages.home_page') }}</span>
                    </a>
                </div>
                {{-- ---------------------------begin main menu  and sub menu------------------------ --}}
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('messages.main_menu') }}</span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                       stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                </svg>

                        </span>
                        <span class="menu-title">کاربران</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.users' ? 'active' : '' }}"
                               href="{{ route('admin.users') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست کاربران</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.admins' ? 'active' : '' }}"
                               href="{{ route('admin.admins') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست مدیران</span>
                            </a>
                        </div>
                        @if( $user->hasRole('super_admin') )
                            <div class="menu-item">
                                <a class="menu-link {{ $route === 'admin.roles' ? 'active' : '' }}"
                                   href="{{ route('admin.roles') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">نقش ها</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ $route === 'admin.perms' ? 'active' : '' }}"
                                   href="{{ route('admin.perms') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">مجوز ها</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ $route === 'admin.role.list.users' ? 'active' : '' }}"
                                   href="{{ route('admin.role.list.users') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">تحصیص نقش</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ $route === 'admin.perm.list.users' ? 'active' : '' }}"
                                   href="{{ route('admin.perm.list.users') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">تخصیص مجوز</span>
                                </a>
                            </div>
                        @else

                        @endif
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                </svg>


                        </span>
                        <span class="menu-title">اصلی</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.category.index' ? 'active' : '' }}"
                               href="{{ route('admin.category.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.categories') }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.category.create' ? 'active' : '' }}"
                               href="{{ route('admin.category.create') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.new_category') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.brand.index' ? 'active' : '' }}"
                               href="{{ route('admin.brand.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.brands') }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.brand.create' ? 'active' : '' }}"
                               href="{{ route('admin.brand.create') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.new_brand') }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.colors.index' ? 'active' : '' }}"
                               href="{{ route('admin.colors.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.colors') }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.category.attribute.index' ? 'active' : '' }}"
                               href="{{ route('admin.category.attribute.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.attributes') }}</span>
                            </a>
                        </div>
                       <div class="menu-item">
                           <a class="menu-link {{ $route === 'admin.attribute.index' ? 'active' : '' }}"
                              href="{{ route('admin.attribute.index') }}">
                               <span class="menu-bullet">
                               <span class="bullet bullet-dot"></span>
                               </span>
                               <span class="menu-title">{{ __('messages.product_specifications') }}</span>
                           </a>
                       </div>
                       <div class="menu-item">
                           <a class="menu-link {{ $route === 'admin.attribute.value.index' ? 'active' : '' }}"
                              href="{{ route('admin.attribute.value.index') }}">
                               <span class="menu-bullet">
                               <span class="bullet bullet-dot"></span>
                               </span>
                               <span class="menu-title">{{ __('messages.product_specifications_values') }}</span>
                           </a>
                       </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.tag.index' ? 'active' : '' }}"
                               href="{{ route('admin.tag.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.tags') }}</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item">
                           <a class="menu-link {{ $route === 'admin.tags.index' ? 'active' : '' }}"
                              href="{{ route('admin.tags.index') }}">
                               <span class="menu-bullet">
                               <span class="bullet bullet-dot"></span>
                               </span>
                               <span class="menu-title">مدیریت برچسب ها</span>
                           </a>
                       </div> --}}
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.product.type.index' ? 'active' : '' }}"
                               href="{{ route('admin.product.type.index') }}">
								<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">مدیریت نوع کالا</span>
                            </a>
                        </div> --}}
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.brand.type' ? 'active' : '' }} "
                               href="{{ route('admin.brand.type') }}">
								<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
								</span>
                                <span class="menu-title">تخصیص برندها</span>
                            </a>
                        </div> --}}

                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                            </svg>


                        </span>
                        <span class="menu-title">مدیریت کالاها</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.product.index' ? 'active' : '' }}"
                               href="{{ route('admin.product.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">لیست کالاها</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.product.create.basic' ? 'active' : '' }}"
                               href="{{ route('admin.product.create.basic') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">کالای جدید</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.stock.product.index' ? 'active' : '' }}"
                               href="{{ route('admin.stock.product.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.stock_management') }}</span>
                            </a>
                        </div>
                    </div>
                </div>


                {{-- start  payments  --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                               stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                        </svg>

                        </span>
                        <span class="menu-title">مدیریت پرداخت ها</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.payments.all.index' ? 'active' : '' }}"
                               href="{{ route('admin.payments.all.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.all_payments') }}</span>
                            </a>
                        </div>
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.payments.offline.index' ? 'active' : '' }}"
                               href="{{ route('admin.payments.offline.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.offline_payments') }}</span>
                            </a>
                        </div>
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.payments.online.index' ? 'active' : '' }}"
                               href="{{ route('admin.payments.online.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.online_payments') }}</span>
                            </a>
                        </div>
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.payments.cash.index' ? 'active' : '' }}"
                               href="{{ route('admin.payments.cash.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.payment_on_the_spot') }}</span>
                            </a>
                        </div>

                    </div>
                </div>
                {{-- end payments     --}}
                {{-- start  orders   --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">


                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                            </svg>


                        </span>
                        <span class="menu-title">{{ __('messages.orders_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        {{--   all orders   --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.orders.index' ? 'active' : '' }}"
                               href="{{ route('admin.orders.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.all_orders') }}</span>
                            </a>
                        </div>
                        {{--   new orders   --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.orders.new' ? 'active' : '' }}"
                               href="{{ route('admin.orders.new') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.orders_new') }}</span>
                            </a>
                        </div>


                        {{--   sending orders   --}}
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.orders.sending' ? 'active' : '' }}"
                               href="{{ route('admin.orders.sending') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.orders_sending') }}</span>
                            </a>
                        </div>
                        {{--   unpaid orders   --}}
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.orders.unpaid' ? 'active' : '' }}"
                               href="{{ route('admin.orders.unpaid') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.orders_unpaid') }}</span>
                            </a>
                        </div>

                        {{--   canceled orders   --}}
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.orders.canceled' ? 'active' : '' }}"
                               href="{{ route('admin.orders.canceled') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.orders_canceled') }}</span>
                            </a>
                        </div>
                        {{--   retuended orders   --}}
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.orders.returned' ? 'active' : '' }}"
                               href="{{ route('admin.orders.returned') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.orders_returned') }}</span>
                            </a>
                        </div>


                    </div>
                </div>
                {{-- end orders --}}
                {{-- start common discount  --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">


                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>


                        </span>
                        <span class="menu-title">{{ __('messages.discount_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.common.discount.index' ? 'active' : '' }}"
                               href="{{ route('admin.common.discount.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.common_discount_list') }}</span>
                            </a>
                        </div>
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.coupons.index' ? 'active' : '' }}"
                               href="{{ route('admin.coupons.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.coupon_discount_list') }}</span>
                            </a>
                        </div>
                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.amazing.sale.index' ? 'active' : '' }}"
                               href="{{ route('admin.amazing.sale.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.amazing_sales_list') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- end discount     --}}
                {{-- start shipment    --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </span>
                        <span class="menu-title">{{ __('messages.delivery_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.delivery.index' ? 'active' : '' }}"
                               href="{{ route('admin.delivery.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.delivery_types') }}</span>
                            </a>
                        </div>


                        <div class="menu-item ">
                            <a class="menu-link {{ $route === 'admin.delivery.create' ? 'active' : '' }}"
                               href="{{ route('admin.delivery.create') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.new_delivery') }}</span>
                            </a>
                        </div>

                    </div>
                </div>
                {{-- end shipment --}}

                {{-- start  address   --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                        </svg>


                        </span>
                        <span class="menu-title">آدرس ها</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link  {{ $route === 'admin.province.index' ? 'active' : '' }}"
                               href="{{ route('admin.province.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.cities_and_provinces_management') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- end  address   --}}
                {{-- start comments --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/>
                        </svg>

                        </span>
                        <span class="menu-title">{{ __('messages.comments') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link  {{ $route === 'admin.product_comments.index' ? 'active' : '' }}"
                               href="{{ route('admin.product_comments.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.management_comments') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- end comment --}}

                {{-- start tickets --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                        </svg>


                        </span>
                        <span class="menu-title">{{ __('messages.tickets_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">


                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.category.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.category.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.category_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.priority.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.priority.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.priority_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.admin.tickets.index' ? 'active' : '' }}"
                               href="{{ route('admin.admin.tickets.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.admin_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.all.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.all.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.all_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.new.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.new.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.new_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.open.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.open.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.open_tickets') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.close.tickets' ? 'active' : '' }}"
                               href="{{ route('admin.close.tickets') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.close_tickets') }}</span>
                            </a>
                        </div>


                    </div>
                </div>
                {{-- end tickets --}}


                {{-- start banner --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                   stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                            </svg>

                        </span>
                        <span class="menu-title">{{ __('messages.banners_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        {{--   top banner    --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.top.banner.index' ? 'active' : '' }}"
                               href="{{ route('admin.top.banner.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.top_banner') }}</span>
                            </a>
                        </div>
                        {{--    amazing product banner    --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.amazing.banner.index' ? 'active' : '' }}"
                               href="{{ route('admin.amazing.banner.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.amazing_offer_banner') }}</span>
                            </a>
                        </div>


                        {{--    bottom two banner    --}}
                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.bottom.banner.index' ? 'active' : '' }}"
                               href="{{ route('admin.bottom.banner.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.bottom_banner') }}</span>
                            </a>
                        </div>

                    </div>
                </div>
                {{-- end banner --}}


                {{-- start slider --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                            </svg>


                        </span>
                        <span class="menu-title">{{ __('messages.sliders_management') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.main.slider.index' ? 'active' : '' }}"
                               href="{{ route('admin.main.slider.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.main_banner_slider') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.product.category.index' ? 'active' : '' }}"
                               href="{{ route('admin.product.category.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.slider_product_by_category') }}</span>
                            </a>
                        </div>


                    </div>
                </div>
                {{-- end slider --}}

                {{-- notification emial sms --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                               stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>

                        </span>
                        <span class="menu-title">{{ __('messages.notices') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.email.notices.index' ? 'active' : '' }}"
                               href="{{ route('admin.email.notices.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.email_notification') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.sms.notices.index' ? 'active' : '' }}"
                               href="{{ route('admin.sms.notices.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.sms_notification') }}</span>
                            </a>
                        </div>


                    </div>
                </div>
                {{-- end notification emial sms --}}

                {{-- start setting --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">

                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>


                        </span>
                        <span class="menu-title">{{ __('messages.setting_site') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            <a class="menu-link {{ $route === 'admin.setting.index' ? 'active' : '' }} "
                               href="{{ route('admin.setting.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('messages.setting_site') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- end setting --}}

            </div>

        </div>
    </div>

    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="#" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover"
           data-bs-dismiss-="click">
            <span class="btn-label">مستندات</span>
            <span class="svg-icon btn-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path
                            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                            fill="#000000" opacity="0.3"/>
                        <path
                            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                            fill="#000000"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5"
                              height="2" rx="1"/>
                        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9"
                              height="2" rx="1"/>
                    </g>
                </svg>
            </span>
        </a>
    </div>
    <!--end::Footer-->
</div>
