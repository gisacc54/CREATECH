@extends('admin.layouts.main')

@section('content')
    @include('admin.users.partials.page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('element.staffs-list')}}</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <select class="form-select form-select-sm limit-bar">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-muted d-inline">
                                    <div class="input-group  input-group-flat input-group-sm search-div">
                                        <input type="text" size="15" class="form-control form-control-sm search-bar" placeholder="{{__('element.search')}}..." aria-label="Search invoice" autocomplete="off">
                                        <span class="input-group-text input-group-sm">
                                            <a href="#" class="link-secondary search-tools" title="" data-bs-toggle="tooltip">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="search-btn" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable" id="users-list">
                                <thead>
                                <tr>
                                    <th class="w-1">
                                        {{__('table.no')}}.
                                    </th>
                                    <th>{{__('table.user')}}</th>
                                    <th>{{ __('table.phone-number') }}</th>
                                    <th>{{__('table.role')}}</th>
                                    <th>{{__('table.status')}}</th>
                                    <th>{{__('table.registered-at')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="users-list-body">
                                <tr>
                                    <td colspan="6">
                                        <center>
                                            <div class="spinner-border spinner-border-sm" role="status"></div>
                                        </center>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted" >Showing <span id="result-point-from">0</span> to <span id="result-point-to">0</span> of <span id="result-point-total">0</span> entries</p>
                            <ul class="pagination m-0 ms-auto" id="pagination-link">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                                        prev
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.modals._create-user-modal')
@endsection

@push('js')
    <script>
        var table = $('#staffs-list-body')
        var currentUrl
        var searchQuery = ''
        var limit = 5


        $(document).ready(function () {
            getUsersTableRows()
            $('.search-bar').on('keyup',function () {
                var q = this.value.trim()
                searchQuery = q
                var searchTool = this.parentNode.querySelector('.search-tools');
                searchTool.innerHTML = generateSearchBtn();
                searchToolHtml =searchTool.innerHTML;
                element = searchTool.querySelector('.search-clear')
                if(q.length>0){
                    searchTool.innerHTML = generateSearchTextClear()+searchToolHtml
                    registerClear()
                }
                $('.search-btn').on('click',function (e) {
                    var searchBar = this.parentNode.parentNode.parentNode.querySelector('.search-bar')
                    generateSearchUrl(searchBar.value);
                })
            })

            $('.limit-bar').on('change',function () {
                generateLimitUrl(this.value)
            })
        })

        function getUsersTableRows(url) {
            url = url??'/admin/ajax/get/staffs'
            renderTableLoader()
            $.ajax({
                url:url,
                method:'get',
                success: function (response) {
                    renderUserTable(response)
                    renderPaginationResultDetails(response)
                    renderPaginationLink(response)
                }
            })
        }

        function renderUserTable(response) {
            let tableBody = ''
            if (response.data.length === 0){
                tableBody = renderTableNoData()
            }
            var num = 1
            response.data.forEach(function (user) {
                var statusBody = ''
                if(user.status === 'Active'){
                    statusBody = `<span class="badge badge-pill bg-green-lt" style="background: rgba(86,154,84,.15)!important">
                                           <i class="fas fa-check-circle" style="margin-right: 2px"></i>
                                            ${user.status}
                                   </span>`
                }else {
                    statusBody = `<span class="badge badge-pill bg-red-lt me-1" style="background-color: rgba(214,57,57,.15)!important">
                                            <i class="fas fa-times-circle" style="margin-right: 2px"></i>
                                             ${user.status}
                                    </span>`
                }
                tableBody += `<tr>
                                    <td><span class="text-muted">${num}</span></td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2" style="background-image: url(${user.profile_image})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">${user.first_name} ${user.last_name}</div>
                                                <div class="text-muted"><a href="#" class="text-reset">${user.email}</a></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        ${user.phone_number}
                                    </td>
                                    <td>
                                        ${user.role_name}
                                    </td>
                                    <td>
                                        ${statusBody}
                                    </td>
                                    <td>
                                        ${user.created_at}
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-ghost-secondary active" title="View"> <i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-ghost-primary active" title="Edit"> <i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-ghost-danger active" title="Delete"> <i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>`
                num++
            })
            table.html(tableBody)
        }

        function renderPaginationResultDetails(response) {
            $('#result-point-from').html(response.from)
            $('#result-point-to').html(response.to)
            $('#result-point-total').html(response.total)
        }

        function renderPaginationLink(response) {
            var linkBody = ''
            response.links.forEach(function (link) {
                var lable = link.label
                if(link.label === '&laquo; Previous'){
                    lable = `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                                        prev`
                }
                if(link.label === 'Next &raquo;'){
                    lable = `next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`
                }
                if(link.label == response.current_page){
                    linkBody+=`<li class="page-item  active"><a class="page-link" href="#">${lable}</a></li>`
                    currentUrl = link.url+(searchQuery !==''?'&q='+searchQuery:'')
                }else {
                    linkBody+=`<li class="page-item   ${link.url === null?"disabled":""}"><a class="page-link pagination-link" href="${link.url??"#"}${searchQuery !==''?'&q='+searchQuery:''}">${lable}</a></li>`

                }
            })

            $('#pagination-link').html(linkBody)

            $('.pagination-link').on('click',function (e) {
                e.preventDefault()
                var url = this.getAttribute('href')
                getUsersTableRows(url)
            })
        }

        function renderTableLoader() {
            table.html(`<tr>
                                    <td colspan="6">
                                        <center>
                                            <div class="spinner-border spinner-border-sm" role="status"></div>
                                        </center>
                                    </td>
                                </tr>`)
        }
        function renderTableNoData() {
            table.html(`<tr>
                            <td colspan="6">
                                <center>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                    No data found
                                </center>
                            </td>
                        </tr>`)
        }

        function appendParameterToUrl(param) {

        }

        function generateSearchTextClear() {
            return `<svg xmlns="http://www.w3.org/2000/svg" class="search-clear" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`
        }
        function generateSearchBtn() {
            return `<svg xmlns="http://www.w3.org/2000/svg" class="search-btn" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>`
        }

        function registerClear() {
            $('.search-clear').on('click',function () {
                this.parentNode.parentNode.parentNode.querySelector('.search-bar').value = ""
                this.parentNode.innerHTML = generateSearchBtn()
                searchQuery = ''
                if(currentUrl.includes('&q='))
                    getUsersTableRows()
            })
        }

        function generateSearchUrl(value) {
            var baseUrl = '/admin/ajax/get/staffs'
            if(limit !== 5){
                baseUrl +=`?q=${value}&limit=${limit}`
            }else {
                baseUrl +=`?q=${value}`

            }
            getUsersTableRows(baseUrl)
        }
        function generateLimitUrl(value) {
            var baseUrl = '/admin/ajax/get/staffs'
            if(searchQuery !== ''){
                baseUrl +=`?q=${searchQuery}&limit=${value}`
            }else {
                baseUrl +=`?limit=${value}`

            }
            getUsersTableRows(baseUrl)
        }
    </script>
@endpush
