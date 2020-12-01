<aside id="main-sidebar" class="dt-sidebar">
    <div class="dt-sidebar__container">

        <!-- Sidebar Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">main</span>
            </li>
            <!-- /menu header -->

            <!-- Menu Item -->
            <li class="dt-side-nav__item {{Request::is('admin')? "open" : ""}}">
                <a href="/admin" class="dt-side-nav__link dt-side-nav__arrow" title="Dashboard">
                    <i class="icon icon-dashboard icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Dashboard</span>
                </a>


            </li>
            <li class="dt-side-nav__item {{Request::is('admin/users*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Users</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="{{route('users.create')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Create</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="{{route('users.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Users</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.manager.request')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Manager Requests</span>
                        </a>
                    </li>



                </ul>
                <!-- /sub-menu -->

            </li>

            <li class="dt-side-nav__item {{Request::is('admin/roles*')? "open" : ""}}">
                <a href="{{route('roles.index')}}" class="dt-side-nav__link" title="Roles">
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Roles</span>
                </a>
            </li>

            <!-- /menu item -->

        </ul>
        <!-- /sidebar navigation -->

        <!-- Sidebar-property Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">Property</span>
            </li>
            <!-- /menu header -->

            <!-- Menu Item -->
            <li class="dt-side-nav__item {{Request::is('admin/manage/property*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Property</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="{{route('property.create')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Create</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.properties.verified')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Verified Properties</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.properties.unverified')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Unverified Properties</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.properties.featured')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Featured Properties</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('property.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Properties</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->

            </li>
            <li class="dt-side-nav__item {{Request::is('admin/property/features*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Property Feature</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="{{route('features.create')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Create</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="{{route('features.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Features</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->

            </li>

            <li class="dt-side-nav__item {{Request::is('admin/property/categories*') || Request::is('admin/property/subcategories*') ? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Property Type</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="{{route('categories.index')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Parent Type</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="{{route('subcategories.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Sub Type</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->

            </li>

            <li class="dt-side-nav__item {{Request::is('admin/property/status*')? "open" : ""}}">
                <a href="{{route('status.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Property Status</span>
                </a>
            </li>

            <li class="dt-side-nav__item {{Request::is('admin/requests*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Requests</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.request.verification')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Verification</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.request.featured')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Featured</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('admin.request.index')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Manager</span>
                        </a>
                    </li>



                </ul>
                <!-- /sub-menu -->

            </li>


            <!-- /menu item -->


        </ul>
        <!-- /sidebar-property navigation -->

        <!-- Sidebar-pages Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">Pages</span>
            </li>
            <!-- /menu header -->

            <li class="dt-side-nav__item {{Request::is('admin/about-us')? "open" : ""}}">
                <a href="{{route('admin.editAbout')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">About Us</span>
                </a>
            </li>


            <!-- /menu item -->

        </ul>
        <!-- /sidebar-pages navigation -->

        <!-- Sidebar-site Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">Site</span>
            </li>
            <!-- /menu header -->

            <li class="dt-side-nav__item {{Request::is('admin/team*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Team</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="{{route('designations.index')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Designations</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="{{route('members.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Members</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->

            </li>

            <li class="dt-side-nav__item {{Request::is('admin/blogs*')? "open" : ""}}" >
                <a href="javascript:void(0)" class=" dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Blogs</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">

                    <li class="dt-side-nav__item">
                        <a href="{{route('blogs.index')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Blogs</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="{{route('blogs-category.index')}}" class="dt-side-nav__link" >
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Categories</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="{{route('blogs-tag.index')}}" class="dt-side-nav__link">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">All Tags</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->

            </li>

            <li class="dt-side-nav__item {{Request::is('admin/plans/pricing*')? "open" : ""}}">
                <a href="{{route('pricing.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Pricing Plans</span>
                </a>
            </li>


            <li class="dt-side-nav__item {{Request::is('admin/faqs*')? "open" : ""}}">
                <a href="{{route('faqs.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Faqs</span>
                </a>
            </li>

            <li class="dt-side-nav__item {{Request::is('admin/testimonials*')? "open" : ""}}">
                <a href="{{route('testimonials.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Testimonials</span>
                </a>
            </li>

            <li class="dt-side-nav__item {{Request::is('admin/privacy-policy*')? "open" : ""}}">
                <a href="{{route('policy.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Privacy Policy</span>
                </a>
            </li>

            <li class="dt-side-nav__item {{Request::is('admin/terms-conditions*')? "open" : ""}}">
                <a href="{{route('conditions.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Terms And Conditions</span>
                </a>
            </li>


            <li class="dt-side-nav__item {{Request::is('admin/subscribers*')? "open" : ""}}">
                <a href="{{route('admin.subscribers')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Subscribers</span>
                </a>
            </li>

            <li class="dt-side-nav__item {{Request::is('admin/sponsers*')? "open" : ""}}">
                <a href="{{route('sponsers.index')}}" class="dt-side-nav__link" >
                    <i class="icon icon-metrics icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Sponsers</span>
                </a>
            </li>

            <!-- /menu item -->

        </ul>
        <!-- /sidebar-site navigation -->

    </div>
</aside>