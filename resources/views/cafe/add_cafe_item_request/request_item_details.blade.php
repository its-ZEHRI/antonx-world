<form method="post" id="itme_remark_form" action="javascript:save_request_remark();" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="nk-msg-reply nk-reply" data-simplebar>
                <div class="nk-reply-item p-0">
                    <div class="nk-reply-header">
                        <div class="title"><b>Request Details</b></div>

                        <div class="date-time">{{ parse_datetime_get($cafe_item->created_at) }}</div>
                    </div>
                    <div class="nk-reply-body ml-0">
                        <div class="nk-reply-entry entry">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span><b>Request By:</b></span>
                                    </td>
                                    <td>
                                        <div class="user-card justify-between">
                                            <div class="user-name">{{ $cafe_item->user->name }}</div>
                                            <div class="user-avatar sm" style="border-radius: 20%;background: none">
                                                <img src="{{ asset($cafe_item->user->image_url) }}" alt="User"
                                                    style="width: 100%; height:100%;object-fit: cover;border-radius: 20%" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0" colspan="2">
                                        <span class="title"><b>Requested Item Deatils</b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span><b>Brand Name:</b></span>
                                    </td>
                                    <td>
                                        <div class="user-card justify-between">
                                            <div class="user-name">{{ $cafe_item->brand_name }}</div>
                                            <div class="user-avatar sm item_image_dive">
                                                <img class="item_image" src="{{ asset($cafe_item->item_image) }}"
                                                    alt="User"
                                                    style="width: 100%; height:100%;object-fit: cover;border-radius: 20%" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span><b>size:</b></span>
                                    </td>
                                    <td>
                                        <p>{{ $cafe_item->size }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span><b>price<code>/per</code>:</b></span>
                                    </td>
                                    <td>
                                        <span>{{ $cafe_item->price }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!-- .nk-reply-item -->
            </div><!-- .nk-reply -->
        </div>
        <div class="col-lg-6">
            <div class="col-lg-12 mb-4">
                @if ($cafe_item)
                    <input type="hidden" value="{{ $cafe_item->id }}" name="id">
                @endif
                <div class="form-group">
                    <label class="form-label" for="cf-default-textarea">Remarks<code>*</code></label>
                    <div class="form-control-wrap">
                        <textarea class="form-control form-control-sm" id="remark" name="remark"
                            value="{{ $cafe_item ? $cafe_item->remarks : '' }}" required>{{ $cafe_item ? $cafe_item->remarks : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-5">
                <div class="form-group">
                    <label class="form-label" for="status">Request Status<code>*</code></label>
                    <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control" name="status" id="status">
                                <option value="" selected disabled>Select Current Request Status
                                </option>
                                @if ($cafe_item)
                                    <option {{ $cafe_item ? 'selected' : '' }}
                                        value="{{ $cafe_item->request_status }}">
                                        {{ $cafe_item->request_status }}</option>
                                @endif
                                <option value="pending">pending</option>
                                <option value="accepted">accepted</option>
                                <option value="rejected">rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex align-end" style="justify-content: space-between">
                <div>
                    <span><b>Remarks By: </b></span>
                    <span>
                        {{ isset($cafe_item->remarkBy->name) ? $cafe_item->remarkBy->name : '' }}
                    </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Remark</button>
                    <button type="reset" class="btn btn-danger">Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
