<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">

            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; 2022
                        <a href="." class="link-secondary"><b>
                                @php
                                    echo env('APP_NAME')
                                @endphp
                            </b></a>.
                        All rights reserved.
                    </li>
                    <li class="list-inline-item">
                        <x-version/>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
