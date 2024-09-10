<?php include '../connect/session_check.php'; ?>
<?php include '../layouts/head-main.php'; ?>

<?php include '../layouts/body.php'; ?>

<?php include '../layouts/head-css.php'; ?>
<?php include '../layouts/menu.php'; ?>

   

<div class="admins_section">
    <div class="main-content">
            <div class="page-content page-padding">
                <div class="container-fluid">

                    <div class="row d-flex flex-row flex-nowrap align-items-center mb-4">
                            <div class="col">
                                <div class="card margin-remove card-remove">
                                    <div class="card-body card-padding-remove">
                                        <div id="customerList">
                                            <div class="d-flex justify-content-sm-start">
                                                <div class="input-group search-box">
                                                    <input type="text" class="form-control search" id="searchInput" placeholder="Search for reference number, guest, email, package, date, and status">
                                                    <span class="input-group-text btn-icons position-relative" id="basic-addon2">
                                                        <i class="ri-search-line filter-icon"></i>
                                                        <i class="ri-filter-3-line search-icon" id="searchIcon"></i>
                                                    </span>
                                                </div>
                                            </div>       
                                        </div>
                                    </div><!-- end card -->
                                </div>
                            </div>
                            <div class=".d-none .d-sm-block col col-lg-3 col-md-3 col-sm-3 change-btn-width">
                                <div class="w-100">
                                    <button type="button" class="w-100 btn btn-success add-btn d-flex flex-row align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                        <i class="ri-add-circle-line add-icon"></i><span class="hide-text ms-1">Add Admin</span>
                                    </button>
                                </div>
                            </div>
                        </div><!-- end card -->

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body card-margin">
                                        <div id="bookingManagementData" class="table-responsive table-card">
                                            <table class="table align-middle table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="id_num">ID No.</th>
                                                        <th class="sort" data-sort="member">Member</th>
                                                        <th class="sort" data-sort="email">Email</th>
                                                        <th class="sort" data-sort="membership">Membership</th>
                                                        <th class="sort" data-sort="date_registered">Date Registered</th>
                                                        <th class="sort" data-sort="status">Status</th>
                                                        <th class="sort" data-sort="payment_status">Payment Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bookingList" class="list">
                                                    <!-- Dynamic content will be loaded here -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                                    orders for you search.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p id="bookingCount">Showing 0 from 0 data</p>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                            <!-- Pagination links will be dynamically inserted here -->
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
            

            <div>
                <button type="button" class="btn btn-white bg-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Static Backdrop Modal
                </button>       

                

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

                        <div class="modal-content main-user-container">
                            <div class="position-absolute top-0 me-3 pt-3 cursor-pointer">
                                <button type="button" href="javascript:void(0);" class="btn btn-link link-success fw-medium btn-close text-reset" data-bs-dismiss="modal"></button>

                            </div>
                            <!--Profile Page-->
                            <div class="container first-user-container me-3 bg-white ">

                                <div class="">
                                    <div class="title-user ">
                                        <h5 class="user-name fw-meduim pb-2">Julienne Galvez</h5>
                                        <div class="users-profile">
                                            <div><img src="../assets/img/users/diamond.svg" class="user-name me-0"></div>
                                            <div><p class="user-name fw-medium">Maharlika</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="personal-info mt-4 ms-3 mb-4">
                                            <div class="me-2"><img src="../assets/img/users/phone.svg" class="user-name me-0" width="18px"></div>
                                            <div><p class="user-name mt-1 fw-normal"><span>+63 </span>9876543210</p></div>
                                        </div>
                                        <div class="personal-info mt-2 ms-3 mb-4">
                                            <div class="me-2"><img src="../assets/img/users/email.svg" class="user-name me-0" width="18px"></div>
                                            <div><p class="user-name mt-1 fw-normal">juliennegalvez@gmail.com</p></div>
                                        </div>
                                        <div class="personal-info mt-2 ms-3 mb-4">
                                            <div class="me-2"><img src="../assets/img/users/bday.svg" class="user-name me-0" width="18px"></div>
                                            <div><p class="user-name mt-1 fw-normal">January 1, 2000</p></div>
                                        </div>
                                        <div class="personal-info mt-2 ms-3 mb-4">
                                            <div class="me-2"><img src="../assets/img/users/address.svg" class="user-name me-0" width="18px"></div>
                                            <div class="address-container"><p class="user-name mt-1 fw-normal">128 Dominican Rd., Lourdes Proper, Baguio City</p></div>
                                        </div>
                                        <div class="personal-info mt-2 ms-3 mb-4">
                                            <div class="me-2"><img src="../assets/img/users/status.svg" class="user-name me-0" width="18px"></div>
                                            <div><p class="user-name mt-1 fw-normal">Student</p></div>
                                        </div>
                                        <div class="personal-info mt-2 ms-3">
                                            <div class="me-2"><img src="../assets/img/users/school.svg" class="user-name me-0" width="18px"></div>
                                            <div><p class="user-name mt-1 fw-normal">University of the Cordilleras</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Inclusions-->
                            <div class="container second-user-container bg-white pt-5 ps-4 me-3">
                                <div class="">
                                    <h6 class="fw-light mb-4 inclusion-title">Inclusions</h6>
                                </div>
                                <div class="">
                                    <ul class="list-inclusions">
                                        <li class="mb-2">Virtual Office Address</li>
                                        <li class="mb-2">Host Events 2x</li>
                                        <li class="mb-2">Member Announcement on BLINC FB Page</li>
                                        <li class="mb-2">Logo Placement on Website industry partner list and social media</li>
                                        <li class="mb-2">Member Feature on BLINC Magazines</li>
                                        <li class="mb-2">Use of BLINC logo</li>
                                        <li class="mb-2">Certificate of Recognition</li>
                                        <li class="mb-2">RSVP events invitation via email</li>
                                        <li class="mb-2">Participation discounts for BLINC events</li>
                                        <li class="mb-2">Networking Opportunities</li>
                                        <li class="mb-2">Inclusive of Collab Amenities</li>
                                        <li class="mb-2">Discounts on other BLINC Services</li>
                                    </ul>
                                </div>
                            </div>

                            <!--Billings-->
                            <div class="container third-user-container bg-white pt-5 ps-4">

                                <div class="row mb-4 custom-margin">
                                    <div class="billing-list" >
                                        <div class="col d-flex flex-column me-4">
                                            <h6 class="fw-normal me-auto guest-style">Billing and Payment</h6>
                                        </div>
                                        <div class="align-content-center justify-content-center">
                                            <a href="#" class="billing-history">View billing history</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 custom-margin">
                                    <div class="billing-list" >
                                        <div class="col d-flex flex-column me-4">
                                            <h6 class="online fw-normal mt-1 mb-1">Online</h6>
                                        </div>
                                        <div class="">
                                            <p class="pending mt-1 mb-1">Pending</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 custom-margin">
                                    <div class="billing-list" >
                                        <div class="col d-flex flex-column">
                                            <div class="billing-payment me-4">
                                                <div><img src="../assets/img/users/yellow-diamond.svg" class="user-name me-0"></div>
                                                <div class="mt-1"><h6 class="maharlika user-name fw-normal">Maharlika</h6></div>
                                            </div>
                                        </div>
                                        <div class="align-content-center justify-content-center">
                                            <h6 class="fw-normal">₱86,000/year</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 custom-margin">
                                    <div class="billing-list" >
                                        <div class="col d-flex flex-column me-4">
                                            <h6 class="next-payment fw-normal me-auto ">Next payment due on</h6>
                                        </div>
                                        <div class="align-content-center justify-content-center">
                                            <h6 class="next-payment fw-normal">April 1, 2025</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-billing">
                                    <div><button class="hold-billing">HOLD</button></div>
                                    <div><button class="cancel-billing">CANCEL</button></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </div>
</div>







</body>

</html>