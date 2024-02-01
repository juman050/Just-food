<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">JUSTFOOD DASHBOARD SIDEBAR</li>

            <li class="{{(\Request::segment(1)=='dashboard' ? 'active' : '')}}"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>


            <li class="treeview {{(\Request::segment(2)=='settings' ? 'active' : '')}}">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Theme & Store</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(\Request::segment(3)=='site' ? 'active' : '')}}"><a href="{{route('site')}}"><i class="fa fa-circle-o"></i> Theme settings</a></li>
                    <li class="{{(\Request::segment(3)=='store' ? 'active' : '')}}"><a href="{{route('store')}}"><i class="fa fa-circle-o"></i> Store information</a></li>
                </ul>
            </li>


            <li class="{{(\Request::segment(2)=='slider' ? 'active' : '')}}"><a href="{{route('slider.index')}}"><i class="fa fa-sliders"></i> <span>Sliders</span></a></li>

            <li class="{{(\Request::segment(2)=='allergysection' ? 'active' : '')}}"><a href="{{route('allergy.index')}}"><i class="fa fa-sticky-note"></i> <span>Allergies</span></a></li>


            <li class="treeview {{((\Request::segment(2)=='order' || \Request::segment(2)=='orders') ? 'active' : '')}}">
                <a href="#">
                    <i class="fa fa-square"></i> <span>Manage Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(\Request::segment(3)=='' ? 'active' : '')}}"><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i>All orders</a></li>
                    <li class="{{(\Request::segment(3)=='pending' ? 'active' : '')}}"><a href="{{ url('/backoffice/orders/pending') }}"><i class="fa fa-circle-o"></i>Pending orders</a></li>
                    <li class="{{(\Request::segment(3)=='processing' ? 'active' : '')}}"><a href="{{ url('/backoffice/orders/processing') }}"><i class="fa fa-circle-o"></i>Processing orders</a></li>
                    <li class="{{(\Request::segment(3)=='delivered' ? 'active' : '')}}"><a href="{{ url('/backoffice/orders/delivered') }}"><i class="fa fa-circle-o"></i>Delivered orders</a></li>
                    <li class="{{(\Request::segment(3)=='cancelled' ? 'active' : '')}}"><a href="{{ url('backoffice/orders/cancelled') }}"><i class="fa fa-circle-o"></i>Cancelled orders</a></li/>
                        <li class="{{(\Request::segment(3)=='not_paid' ? 'active' : '')}}"><a href="{{ url('/backoffice/orders/not_paid') }}"><i class="fa fa-circle-o"></i>Not-paid orders</a></li>
                    </ul>
                </li>

                <li class="treeview {{(\Request::segment(2)=='food' ? 'active' : '')}}">
                    <a href="#">
                        <i class="fa fa-square"></i> <span>Manage Food</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(\Request::segment(3)=='category' ? 'active' : '')}}"><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i>Category</a></li>
                        <li class="{{(\Request::segment(3)=='item' ? 'active' : '')}}"><a href="{{route('item.index')}}"><i class="fa fa-circle-o"></i>Food item</a></li>
                        <li class="{{(\Request::segment(3)=='variance' ? 'active' : '')}}"><a href="{{route('variance.index')}}"><i class="fa fa-circle-o"></i>Food variance</a></li>
                        <li class="{{(\Request::segment(3)=='subitem' ? 'active' : '')}}"><a href="{{route('subitem.index')}}"><i class="fa fa-circle-o"></i>Food Sub item & variance</a></li>
                    </ul>
                </li>


                <li class="treeview {{(\Request::segment(2)=='offer' ? 'active' : '')}}">
                    <a href="#">
                        <i class="fa fa-map-pin"></i> <span>Offers</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(\Request::segment(3)=='index' ? 'active' : '')}}"><a href="{{route('offer.index')}}"><i class="fa fa-circle-o"></i>All offers</a></li>
                        <li class="{{(\Request::segment(3)=='create' ? 'active' : '')}}"><a href="{{route('offer.create')}}"><i class="fa fa-circle-o"></i>Add offer</a></li>
                    </ul>
                </li>


                <li class="{{(\Request::segment(2)=='gallery' ? 'active' : '')}}"><a href="{{route('gallery.index')}}"><i class="fa fa-camera"></i> <span>Gallery</span></a></li>


                <li class="treeview {{(\Request::segment(2)=='postcodeormileage' ? 'active' : '')}}">
                    <a href="#">
                        <i class="fa fa-map-pin"></i> <span>Postcode & Mileage</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(\Request::segment(3)=='postcode' ? 'active' : '')}}"><a href="{{route('postcode.index')}}"><i class="fa fa-circle-o"></i>Postcode</a></li>
                        <li class="{{(\Request::segment(3)=='mileage' ? 'active' : '')}}"><a href="{{route('mileage.index')}}"><i class="fa fa-circle-o"></i>Mileage</a></li>
                    </ul>
                </li>

                <li class="treeview {{(\Request::segment(2)=='otherSettings' ? 'active' : '')}}">
                    <a href="#">
                        <i class="fa fa-wrench"></i> <span>Timing & Maintainence</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(\Request::segment(3)=='openClose' ? 'active' : '')}}"><a href="{{route('openClose')}}"><i class="fa fa-circle-o"></i>Restaurant open/close</a></li>
                        <li class="{{(\Request::segment(3)=='maintainance' ? 'active' : '')}}"><a href="{{route('maintainance')}}"><i class="fa fa-circle-o"></i>Delivery & collection & other</a></li>
                        <li class="{{(\Request::segment(3)=='extraCharge' ? 'active' : '')}}"><a href="{{route('extraCharge')}}"><i class="fa fa-circle-o"></i>Extra charge</a></li>
                    </ul>
                </li>

                <li class="{{(\Request::segment(2)=='payment' ? 'active' : '')}}"><a href="{{route('managePayment')}}"><i class="fa fa-gear"></i> <span>Payment settings</span></a></li>

                <li class="{{(\Request::segment(2)=='customers' ? 'active' : '')}}"><a href="{{route('customers')}}"><i class="fa fa-users"></i> <span>Customers</span></a></li>

                <li class="treeview {{(\Request::segment(2)=='pagesettings' ? 'active' : '')}}">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Page & SEO</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(\Request::segment(3)=='homePage' ? 'active' : '')}}"><a href="{{route('homePage')}}"><i class="fa fa-circle-o"></i> Home page</a></li>
                        <li class="{{(\Request::segment(3)=='menuPage' ? 'active' : '')}}"><a href="{{route('menuPage')}}"><i class="fa fa-circle-o"></i> Menu page</a></li>
                        <li class="{{(\Request::segment(3)=='galleryPage' ? 'active' : '')}}"><a href="{{route('galleryPage')}}"><i class="fa fa-circle-o"></i>Gallery page</a></li>
                        <li class="{{(\Request::segment(3)=='contactPage' ? 'active' : '')}}"><a href="{{route('contactPage')}}"><i class="fa fa-circle-o"></i>Contact page</a></li>
                        <li class="{{(\Request::segment(3)=='termsPage' ? 'active' : '')}}"><a href="{{route('termsPage')}}"><i class="fa fa-circle-o"></i>Terms page</a></li>
                        <li class="{{(\Request::segment(3)=='privacyPage' ? 'active' : '')}}"><a href="{{route('privacyPage')}}"><i class="fa fa-circle-o"></i>Privacy page</a></li>
                        <li class="{{(\Request::segment(3)=='faqPage' ? 'active' : '')}}"><a href="{{route('faqPage')}}"><i class="fa fa-circle-o"></i>FAQ page</a></li>
                    </ul>
                </li>

                <li class="{{(\Request::segment(2)=='contact' ? 'active' : '')}}"><a href="{{url('/backoffice/contact')}}"><i class="fa fa-envelope"></i> <span>Contact messages</span></a></li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>