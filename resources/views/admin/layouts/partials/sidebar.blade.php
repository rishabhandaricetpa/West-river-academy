<!-- Main Sidebar Container -->
<aside class="main-sidebar  admin-sidebar">
    <!-- Brand Logo -->

    <img src="/images/wra_logo.svg" class="d-none  p-1 d-lg-block" alt="wra_logo">
    </a>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu">


            <li class="nav-item">
                <a href="{{ route('admin.archieved.tasks') }}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Archived Tasks
                    </p>
                </a>
            </li>


            <li class="nav-item menu">
                <a href="" class="nav-link ">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>
                        Payments
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.payments') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Enrollment Payments
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.custom.payments') }}" class="nav-link">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                Custom Payments
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.order.postage') }}" class="nav-link">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                Order Postage
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.order.customletter') }}" class="nav-link">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                Custom Letter
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.apostille.notarization') }}" class="nav-link">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                Notarization
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.order.conultation') }}" class="nav-link">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                Personal Consultation
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/payment-address') }}" class="nav-link">
                            <i class="fas fa-address-book"></i>
                            <p>Change Address</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item menu">
                <a href="" class="nav-link ">
                    <i class="nav-icon fas fa-scroll"></i>
                    <p>
                        Transcripts
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.view.transcript') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Transcript K-8
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.view.transcript9_12') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Transcript 9-12
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.transcript.payments') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Transcript Payments
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/manage-courses') }}" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <p>Manage Courses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/archieve/k8display') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>Archived k-8</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/archieve/9_12display') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>Archived 9-12</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.view.coupon') }}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Coupons
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.view.graduation') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Graduation
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/countryenrollments') }}" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Country Data
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('admin/fees-services') }}" class="nav-link transform-none">
                    <i class="nav-icon fas fa-dollar-sign"></i>
                    <p>
                        Fees and Services
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-scroll"></i>
                    <p>
                        Record Transfers
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.record.request') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Lists
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.archieved.requests') }}" class="nav-link">
                            <i class="fas fa-eye"></i>
                            <p>
                                Archieved Tasks
                            </p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.upload.documents') }}" class="nav-link">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Upload Docs
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.upload.podcasts') }}" class="nav-link d-flex">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p class="pl-2">
                        Upload Podcast, audios and videos
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.get.emails') }}" class="nav-link d-flex">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p class="pl-2">
                        Emails
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Log Out
                    </p>
                </a>
            </li>
    </nav>
    <!-- /.sidebar-menu -->
    </ul>
    </li>
    </div>
</aside>
