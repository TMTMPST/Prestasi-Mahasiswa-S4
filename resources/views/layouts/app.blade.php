<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand">
                <svg
                    class="sidebar-brand-full"
                    width="88"
                    height="32"
                    alt="CoreUI Logo"
                >
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg>
                <svg
                    class="sidebar-brand-narrow"
                    width="32"
                    height="32"
                    alt="CoreUI Logo"
                >
                    <use xlink:href="assets/brand/coreui.svg#signet"></use>
                </svg>
            </div>
            <button
                class="btn-close d-lg-none"
                type="button"
                data-coreui-dismiss="offcanvas"
                data-coreui-theme="dark"
                aria-label="Close"
                onclick='coreui.Sidebar.getInstance(document.querySelector("#sidebar")).toggle()'
            ></button>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"
                        ></use>
                    </svg>
                    Dashboard<span class="badge badge-sm bg-info ms-auto"
                        >NEW</span
                    ></a
                >
            </li>
            <li class="nav-title">Theme</li>
            <li class="nav-item">
                <a class="nav-link" href="colors.html">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"
                        ></use>
                    </svg>
                    Colors</a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link" href="typography.html">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"
                        ></use>
                    </svg>
                    Typography</a
                >
            </li>
            <li class="nav-title">Components</li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"
                        ></use>
                    </svg>
                    Base</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a class="nav-link" href="base/accordion.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Accordion</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/breadcrumb.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Breadcrumb</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/components/calendar/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Calendar
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/cards.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Cards</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/carousel.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Carousel</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/collapse.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Collapse</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/list-group.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            List group</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/navs-tabs.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Navs &amp; Tabs</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/pagination.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Pagination</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/placeholders.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Placeholders</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/popovers.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Popovers</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/progress.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Progress</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/spinners.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Spinners</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/tables.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Tables</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/tooltips.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Tooltips</a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"
                        ></use>
                    </svg>
                    Buttons</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a class="nav-link" href="buttons/buttons.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Buttons</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buttons/button-group.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Buttons Group</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buttons/dropdowns.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Dropdowns</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/components/loading-buttons/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Loading Buttons
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"
                        ></use>
                    </svg>
                    Charts</a
                >
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"
                        ></use>
                    </svg>
                    Forms</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a class="nav-link" href="forms/form-control.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Form Control</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/select.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Select</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/multi-select/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Multi Select
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/checks-radios.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Checks and radios</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/range.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Range</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/range-slider/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Range Slider
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/input-group.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Input group</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="forms/floating-labels.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Floating labels</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/date-picker/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Date Picker
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/date-range-picker/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Date Range Picker<span
                                class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/rating/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Rating
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="https://coreui.io/bootstrap/docs/forms/time-picker/"
                            target="_blank"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Time Picker
                            <svg class="icon icon-sm ms-2">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-external-link"
                                ></use></svg
                            ><span class="badge badge-sm bg-danger ms-auto"
                                >PRO</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/layout.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Layout</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/validation.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Validation</a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"
                        ></use>
                    </svg>
                    Icons</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="icons/coreui-icons-free.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            CoreUI Icons<span
                                class="badge badge-sm bg-success ms-auto"
                                >Free</span
                            ></a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="icons/coreui-icons-brand.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            CoreUI Icons - Brand</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="icons/coreui-icons-flag.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            CoreUI Icons - Flag</a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"
                        ></use>
                    </svg>
                    Notifications</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a class="nav-link" href="notifications/alerts.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Alerts</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications/badge.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Badge</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications/modals.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Modals</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications/toasts.html"
                            ><span class="nav-icon"
                                ><span class="nav-icon-bullet"></span
                            ></span>
                            Toasts</a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="widgets.html">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calculator"
                        ></use>
                    </svg>
                    Widgets<span class="badge badge-sm bg-info ms-auto"
                        >NEW</span
                    ></a
                >
            </li>
            <li class="nav-divider"></li>
            <li class="nav-title">Extras</li>
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"
                        ></use>
                    </svg>
                    Pages</a
                >
                <ul class="nav-group-items compact">
                    <li class="nav-item">
                        <a class="nav-link" href="login.html" target="_top">
                            <svg class="nav-icon">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"
                                ></use>
                            </svg>
                            Login</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="register.html"
                            target="_top"
                        >
                            <svg class="nav-icon">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"
                                ></use>
                            </svg>
                            Register</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="404.html" target="_top">
                            <svg class="nav-icon">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bug"
                                ></use>
                            </svg>
                            Error 404</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="500.html" target="_top">
                            <svg class="nav-icon">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bug"
                                ></use>
                            </svg>
                            Error 500</a
                        >
                    </li>
                </ul>
            </li>
            <li class="nav-item mt-auto">
                <a
                    class="nav-link"
                    href="https://coreui.io/docs/templates/installation/"
                    target="_blank"
                >
                    <svg class="nav-icon">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"
                        ></use>
                    </svg>
                    Docs</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link text-primary fw-semibold"
                    href="https://coreui.io/product/bootstrap-dashboard-template/"
                    target="_top"
                >
                    <svg class="nav-icon text-primary">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-layers"
                        ></use>
                    </svg>
                    Try CoreUI PRO</a
                >
            </li>
        </ul>
        <div class="sidebar-footer border-top d-none d-md-flex">
            <button
                class="sidebar-toggler"
                type="button"
                data-coreui-toggle="unfoldable"
            ></button>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100">
        <header class="header header-sticky p-0 mb-4">
            <div class="container-fluid border-bottom px-4">
                <button
                    class="header-toggler"
                    type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
                    style="margin-inline-start: -14px"
                >
                    <svg class="icon icon-lg">
                        <use
                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"
                        ></use>
                    </svg>
                </button>
                <ul class="header-nav d-none d-lg-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                </ul>
                <ul class="header-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"
                                ></use></svg
                        ></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"
                                ></use></svg
                        ></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"
                                ></use></svg
                        ></a>
                    </li>
                </ul>
                <ul class="header-nav">
                    <li class="nav-item py-1">
                        <div
                            class="vr h-100 mx-2 text-body text-opacity-75"
                        ></div>
                    </li>
                    <li class="nav-item dropdown">
                        <button
                            class="btn btn-link nav-link py-2 px-2 d-flex align-items-center"
                            type="button"
                            aria-expanded="false"
                            data-coreui-toggle="dropdown"
                        >
                            <svg class="icon icon-lg theme-icon-active">
                                <use
                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-contrast"
                                ></use>
                            </svg>
                        </button>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            style="--cui-dropdown-min-width: 8rem"
                        >
                            <li>
                                <button
                                    class="dropdown-item d-flex align-items-center"
                                    type="button"
                                    data-coreui-theme-value="light"
                                >
                                    <svg class="icon icon-lg me-3">
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sun"
                                        ></use></svg
                                    >Light
                                </button>
                            </li>
                            <li>
                                <button
                                    class="dropdown-item d-flex align-items-center"
                                    type="button"
                                    data-coreui-theme-value="dark"
                                >
                                    <svg class="icon icon-lg me-3">
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon"
                                        ></use></svg
                                    >Dark
                                </button>
                            </li>
                            <li>
                                <button
                                    class="dropdown-item d-flex align-items-center active"
                                    type="button"
                                    data-coreui-theme-value="auto"
                                >
                                    <svg class="icon icon-lg me-3">
                                        <use
                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-contrast"
                                        ></use></svg
                                    >Auto
                                </button>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item py-1">
                        <div
                            class="vr h-100 mx-2 text-body text-opacity-75"
                        ></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link py-0 pe-0"
                            data-coreui-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <div class="avatar avatar-md">
                                <img
                                    class="avatar-img"
                                    src="assets/img/avatars/8.jpg"
                                    alt="user@email.com"
                                />
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div
                                class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2"
                            >
                                Account
                            </div>
                            <a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"
                                    ></use>
                                </svg>
                                Updates<span
                                    class="badge badge-sm bg-info ms-2"
                                    >42</span
                                ></a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"
                                    ></use>
                                </svg>
                                Messages<span
                                    class="badge badge-sm bg-success ms-2"
                                    >42</span
                                ></a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"
                                    ></use>
                                </svg>
                                Tasks<span
                                    class="badge badge-sm bg-danger ms-2"
                                    >42</span
                                ></a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"
                                    ></use>
                                </svg>
                                Comments<span
                                    class="badge badge-sm bg-warning ms-2"
                                    >42</span
                                ></a
                            >
                            <div
                                class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2"
                            >
                                <div class="fw-semibold">Settings</div>
                            </div>
                            <a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"
                                    ></use>
                                </svg>
                                Profile</a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"
                                    ></use>
                                </svg>
                                Settings</a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"
                                    ></use>
                                </svg>
                                Payments<span
                                    class="badge badge-sm bg-secondary ms-2"
                                    >42</span
                                ></a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"
                                    ></use>
                                </svg>
                                Projects<span
                                    class="badge badge-sm bg-primary ms-2"
                                    >42</span
                                ></a
                            >
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"
                                    ></use>
                                </svg>
                                Lock Account</a
                            ><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"
                                    ></use>
                                </svg>
                                Logout</a
                            >
                        </div>
                    </li>
                </ul>
            </div>
            <div class="container-fluid px-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Dashboard</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </header>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js"
        integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDdRLQ3O9L78gwBbe"
        crossorigin="anonymous"></script>
</body>

</html>

{{--
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html> --}}