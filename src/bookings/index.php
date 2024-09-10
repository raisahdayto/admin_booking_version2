<?php include '../connect/session_check.php'; ?>
<?php include '../layouts/head-main.php'; ?>
<?php include '../layouts/body.php'; ?>
<?php include '../layouts/title-meta.php'; ?>
<?php include '../layouts/head-css.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../layouts/vendor-scripts.php'; ?>

<link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />

<!-- ============================================================== -->
<!-- Calendar -->
<!-- ============================================================== -->

<div class="main-content bg-booking">
    <div class="page-content page-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row first-row">
                        <div class="col-xl-9">
                            <div class="card calendar-height">
                                <div class="card-body">
                                    <div id="calendar"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card ">
                                <div class="card-body">
                                    <p class="heading">Latest Approved Booking</p>
                                    <div class="row approved-item d-flex flex-column flex-nowrap align-items-center" id="latestCard">
                                        <div class="d-flex flex-row flex-nowrap align-items-center">
                                            <div class="col-xl-7 d-flex flex-column guest-col me-auto">
                                                <p class="me-auto ref-num" id="ab_refnum">#0010</p>
                                                <p class="me-auto guest-style" id="ab_name">Julienne Galvez</p>
                                            </div>
                                            <div class="col-1 second-col d-flex flex-column align-items-center">
                                                <img src="../assets/img/booking/term-icon.svg" alt="" width="20" height="20" class="term-icon">
                                                <img src="../assets/img/booking/pax-icon.svg" alt="" width="24" height="24">
                                            </div>
                                            <div class="col-3 third-col d-flex flex-column justify-content-end">
                                                <p class="detail-style" id="ab_term">Hourly</p>
                                                <p class="detail-style" id="ab_pax">3 Pax</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="external-events" class="remove-events-scrollbar">
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div><!--end row-->
        <div style='clear:both'></div>

        <!-- Add New Event MODAL -->
        <div class="modal fade" id="event-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header p-3 bg-soft-info">
                        <h5 class="modal-title" id="modal-title">Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                            <div class="text-end">
                                <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                            </div>
                            <div class="event-details">
                                <div class="d-flex mb-2">
                                    <div class="flex-grow-1 d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="ri-calendar-event-line text-muted fs-16"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="ri-time-line text-muted fs-16"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="d-block fw-semibold mb-0"><span id="event-timepicker1-tag"></span> - <span id="event-timepicker2-tag"></span></h6>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="ri-discuss-line text-muted fs-16"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row event-form">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-select d-none" name="category" id="event-category" required>
                                            <option value="event-full">Fully Booked</option>
                                            <option value="event-booking">Bookings</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid event category</div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Event Name</label>
                                        <input class="form-control d-none" placeholder="Enter event name" type="text" name="title" id="event-title" required value="" />
                                        <div class="invalid-feedback">Please provide a valid event name</div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label>Event Date</label>
                                        <div class="input-group d-none">
                                            <input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input" placeholder="Select date" readonly required>
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-12" id="event-time">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Start Time</label>
                                                <div class="input-group d-none">
                                                    <input id="timepicker1" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select start time" readonly>
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">End Time</label>
                                                <div class="input-group d-none">
                                                    <input id="timepicker2" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly>
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <input type="hidden" id="eventid" name="eventid" value="" />
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control d-none" id="event-description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i class="ri-close-line align-bottom"></i> Delete</button>
                                <button type="submit" class="btn btn-success" id="btn-save-event" value="addEvent">Add Event</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end modal-content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
        <!-- end modal-->
    </div>
</div>


<!-- ============================================================== -->
<!-- Table -->
<!-- ============================================================== -->
<div class="main-content main-bg">
    <div id="bookingManagementData" class="table-responsive">
        <div class="page-content table-padding">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">

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
                                    <button type="button" class="w-100 btn btn-success-style add-btn d-flex flex-row align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                        <i class="ri-add-circle-line add-icon"></i><span class="hide-text ms-1">New Booking</span>
                                    </button>
                                </div>
                            </div>
                        </div><!-- end card -->

                        <!-- end col -->
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body card-margin table-responsive">
                                <table class="table align-middle table-nowrap table-margin">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="reference_num">Reference No.</th>
                                            <th class="sort" data-sort="customer_name">Guest</th>
                                            <th class="sort" data-sort="email">Email</th>
                                            <th class="sort" data-sort="term">Term</th>
                                            <th class="sort" data-sort="date">Booking Date</th>
                                            <th class="sort" data-sort="booking_status">Booking Status</th>
                                            <th class="sort" data-sort="payment_method">Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bookingList" class="list list-style">
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

                        <div id="noResultsMessage" class="text-center" style="display: none;">
                            No matching bookings found.
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

        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- ============================================================== -->
<!-- Booking Modal -->
<!-- ============================================================== -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3">
            <div class="modal-body">
                <div class="row d-flex flex-wrap gap-3 change-modal-flex">
                    <!-- First Column -->
                    <div class="col card card-padding" id="guestInfo">
                        <div class="approved-body card-padding">
                            <div class="membership-card p-5 d-flex flex-column justify-content-center align-items-center" id="guestCard">
                                <p class="guest-name" id="guestName">Julienne Galvez</p>
                                <div class="d-flex flex-row justify-content-center align-items-center" id="guestMembership">
                                    <img src="../assets/img/booking/diamond.svg" alt="" height="20" width="20" class="me-1">
                                    <p class="membership-style" id="membershipType">Maharlika</p>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center align-items-end mt-4" id="guestContactPhone">
                                <div class="row w-100">
                                    <div class="col-2 icon-col" id="phoneIconCol">
                                        <img src="../assets/img/booking/phone.svg" alt="" height="22" width="22" class="me-1">
                                    </div>
                                    <div class="col-auto">
                                        <p class="info-style" id="phoneNumber">+63 9876543210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center align-items-end mt-2 pb-4" id="guestContactEmail">
                                <div class="row w-100">
                                    <div class="col-2 icon-col" id="emailIconCol">
                                        <img src="../assets/img/booking/email.svg" alt="" height="22" width="22" class="me-3">
                                    </div>
                                    <div class="col-auto">
                                        <p class="info-style" id="emailAddress">juliennegalvez@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col card" id="bookingDetails">
                        <div class="card-body">
                            <p class="modal-heading mt-3" id="detailsHeading">Booking Details</p>
                            <div class="d-flex flex-row justify-content-between align-items-center" id="bookingStatusRow">
                                <p class="modal-blue mt-3" id="bookingNumber">#0001</p>
                                <p class="badge-pending mt-3" id="bookingStatus">Pending</p>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between" id="termPaxRow">
                                <div class="col d-flex flex-row justify-content-start align-items-center" id="termColumn">
                                    <div class="row d-flex flex-column">
                                        <div class="col">
                                            <div class="row d-flex flex-row align-items-center">
                                                <div class="col-2 subheading-icon">
                                                    <img src="../assets/img/booking/star.svg" alt="" height="22" width="22">
                                                </div>
                                                <div class="col-auto col-subheading">
                                                    <p class="subheading">Term</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="modal-info heading-align" id="termValue">Hourly</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex flex-row justify-content-end align-items-center" id="paxColumn">
                                    <div class="row d-flex flex-column">
                                        <div class="col remove-padding">
                                            <div class="row d-flex flex-row align-items-center">
                                                <div class="col-2 subheading-icon">
                                                    <img src="../assets/img/sidebar/person-admin.svg" alt="" height="25" width="25">
                                                </div>
                                                <div class="col-auto col-subheading">
                                                    <p class="subheading">Pax</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="modal-info heading-align" id="paxValue">1</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between mt-3 mb-3" id="dateRow">
                                <div class="col d-flex flex-row justify-content-start align-items-center">
                                    <div class="row d-flex flex-column w-100">
                                        <div class="col" id="dateColumn">
                                            <div class="row d-flex flex-row align-items-center">
                                                <div class="col-2 subheading-icon">
                                                    <img src="../assets/img/sidebar/admin-calendar.svg" alt="" height="22" width="22">
                                                </div>
                                                <div class="col-auto col-subheading">
                                                    <p class="subheading remove-margin">Booking Date</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="col d-flex flex-column align-items-start">
                                                <p class="from-style heading-align mt-2">From</p>
                                                <div class="modal-info heading-align" id="dateFrom">April 29, 2024</div>
                                            </div>
                                            <div class="col-3 d-flex flex-column align-items-start">
                                                <p class="to-style heading-align mt-2">To</p>
                                                <div class="modal-info heading-align" id="dateTo">-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between" id="timeColumn">
                                <div class="col d-flex flex-row justify-content-start align-items-center">
                                    <div class="row d-flex flex-column w-100">
                                        <div class="col">
                                            <div class="row d-flex flex-row align-items-center">
                                                <div class="col-2 subheading-icon">
                                                    <img src="../assets/img/booking/clock-icon.svg" alt="" height="22" width="22">
                                                </div>
                                                <div class="col-auto col-subheading">
                                                    <p class="subheading remove-margin">Booking Time</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="col d-flex flex-column align-items-start">
                                                <p class="from-style heading-align mt-2">From</p>
                                                <div class="modal-info heading-align" id="timeFrom">1:00 PM</div>
                                            </div>
                                            <div class="col-3 d-flex flex-column align-items-start">
                                                <p class="to-style heading-align mt-2">To</p>
                                                <div class="modal-info heading-align" id="timeTo">5:00 PM</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Third Column -->
                    <div class="col card" id="paymentDetails">
                        <div class="card-body">
                            <p class="modal-heading mt-3" id="paymentHeading">Payment Details</p>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <p class="modal-blue mt-3" id="paymentMethod">On-site</p>
                                <p class="badge-pending mt-3" id="paymentStatus">Pending</p>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between">
                                <div class="col-8 subheading-icon d-flex flex-row align-items-center">
                                    <img src="../assets/img/booking/star.svg" alt="" height="22" width="22">
                                    <p class="subheading">Term</p>
                                </div>
                                <div class="col-auto">
                                    <div class="modal-info text-align-end" id="termAmount">Hourly ₱75</div>
                                </div>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between mt-3">
                                <div class="col-8 subheading-icon d-flex flex-row align-items-center">
                                    <img src="../assets/img/sidebar/person-admin.svg" alt="" height="22" width="22">
                                    <p class="subheading"># of Pax</p>
                                </div>
                                <div class="col-auto">
                                    <div class="modal-info text-align-end" id="pax">1</div>
                                </div>
                            </div>
                            <div class="row d-flex flex-row align-items-center justify-content-between mt-3">
                                <div class="col-8 subheading-icon d-flex flex-row align-items-center">
                                    <img src="../assets/img/booking/clock-icon.svg" alt="" height="22" width="22">
                                    <p class="subheading">Total Hours</p>
                                </div>
                                <div class="col-auto">
                                    <div class="modal-info text-align-end" id="totalHours">4</div>
                                </div>
                            </div>
                            <div class="row d-flex flex-row justify-content-between align-items-center mt-3">
                                <div class="col-8 subheading-icon d-flex flex-row align-items-center">
                                    <img src="../assets/img/booking/voucher.svg" alt="" height="22" width="22">
                                    <p class="subheading">Voucher</p>
                                </div>
                                <div class="col-auto">
                                    <div class="modal-info" id="voucher">-</div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center mt-4">
                                <p class="modal-blue">Total Amount</p>
                                <p class="modal-blue" id="totalAmount">₱300</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-confirm-booking" data-bs-target="confirmModal" data-bs-dismiss="modal" id="confirmModalButton">Confirm Booking</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<div id="confirmModal"></div>

<!-- Sweet Alerts js -->
<script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- fullcalendar js -->
<link href="../assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />
<script src="../assets/libs/fullcalendar/main.min.js"></script>

<!-- Calendar init -->
<script src="../assets/js/pages/calendar.init.js"></script>
<script src="../assets/js/calendar.js"></script>

<!-- list.js plugin -->
<script src="../assets/libs/list.js/list.min.js"></script>
<script src="../assets/libs/list.pagination.js/list.pagination.min.js"></script>

<!-- listjs init -->
<script src="../assets/js/pages/listjs.init.js"></script>

<!-- App js -->
<script src="../assets/js/app.js"></script>
<script src="../assets/js/global.js"></script>
<script src="../assets/js/bookings.js"></script>
<script src="../assets/js/pages/modal.init.js"></script>

<!-- Include jQuery first -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- END layout-wrapper -->

</body>

</html>