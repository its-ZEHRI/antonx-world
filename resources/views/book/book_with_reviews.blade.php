@extends('layouts.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid p-0">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-between mb-4">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Book News Feed</h4>
                                </div>
                                <div class="nk-block-head-content">
                                    <span class="text-primary font-weight-bolder">
                                        <em class="icon ni ni-calendar"></em>
                                        {{ date('l', strtotime(get_date())) }}</span>
                                    <span>{{ date('d M', strtotime(get_date())) }}</span>
                                    <em class="icon ni ni-clock"></em>
                                    <span id="time_span"></span>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-inner card-inner-xl">
                                    <div class="nk-msg-body bg-white profile-shown">
                                        @foreach ($books as $book)
                                            <div class="card bg-light">
                                                <div class="card-header d-flex justify-between">
                                                    <span>{{ $book->title }}</span>
                                                    <span
                                                        class="date-time">Added on: {{ date('d M Y', strtotime($book->created_at)) }}</span>
                                                </div>
                                                <div class="card-inner">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-4">
                                                                <span class="card-title"><b>Book Title:</b></span>
                                                                <h6>{{ $book->title }}</h6>
                                                            </div>

                                                            <span class="card-title"><b>Categories:</b></span>
                                                            <div class="card-title d-flex">
                                                                @if ($book->category_book)
                                                                    @foreach ($book->category_book as $cat)
                                                                        <span
                                                                            class="badge badge-outline-secondary mb-1 mr-1">{{ $cat->category_list->title }}</span><br>
                                                                    @endforeach
                                                                @else
                                                                    <span>No category added</span>
                                                                @endif

                                                            </div>

                                                            <div class="my-2">
                                                                <span class="card-title"><b>Summary:</b></span>
                                                                <p class="card-text">
                                                                    {{ $book->summary }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div style="height:400px;width: 400px;">
                                                                <img src="{{ asset($book->book_image) }}" alt="Book Image"
                                                                    style="width: 100%; height:100%;object-fit: cover;" />
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="nk-reply-meta my-1">
                                                <div class="nk-reply-meta-info"><strong>Book Reviews</strong>
                                                </div>
                                            </div><!-- .nk-reply-meta -->
                                            @foreach ($book->review as $view)
                                                <div class="nk-msg-reply nk-reply mb-2" data-simplebar>
                                                    <div class="nk-reply-item">
                                                        <div class="nk-reply-header">
                                                            <div class="user-card">
                                                                <div class="user-avatar sm bg-blue">
                                                                    <span>
                                                                        <img src="{{ asset($view->user->image_url) }}"
                                                                            alt="Book Image"
                                                                            style="width: 100%; height:100%;object-fit: cover;" />
                                                                    </span>
                                                                </div>
                                                                <div class="user-name">{{ $view->user->name }}</div>
                                                            </div>
                                                            <div class="date-time">
                                                                {{ date('d M Y', strtotime($view->created_at)) }}
                                                            </div>
                                                        </div>
                                                        <div class="nk-reply-body">
                                                            <div class="nk-reply-entry entry">
                                                                <div class="row">
                                                                    <div class="col-lg-10">
                                                                        <p>{{ $view->comment }}</p>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <p class="text-right">
                                                                            @for ($i = 0; $i < $view->rating; $i++)
                                                                                <em class="icon ni ni-star-fill"
                                                                                    style="color: #ffd000"></em>
                                                                            @endfor
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div> <!-- nk-block -->
                        </div><!-- .components-preview -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            formatAMPM();
            function formatAMPM() {
                var date = new Date()
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                document.getElementById('time_span').innerHTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
        </script>
    @endsection
