<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="col-lg-9 col-md-9 col-sm-12">

        <div class="row">
            <div class="col-xl-7 col-lg-6 col-md-12">
                <div class="dashboard_wrap">

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                            <h6 class="m-0">Basic Detail</h6>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <form action="" method="post" wire:submit="updateStudentProfile()">
                                <div class="form-group smalls">
                                    <label>First Name*</label>
                                    <input type="text" class="form-control" wire:model="first_name" value="{{ auth()->user()->student->first_name ?? '' }}" />
                                </div>
                                <div class="form-group smalls">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" wire:model="last_name" value="{{ auth()->user()->student->last_name ?? '' }}" />
                                </div>
                                <div class="form-group smalls">
                                    <label>Email</label>
                                    <input type="email" class="form-control" wire:model="email" value="{{ auth()->user()->student->email ?? '' }}" />
                                </div>
                                <div class="form-group smalls">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->mobile ?? '' }}" />
                                </div>
                                <div class="form-group smalls">
                                    <label>About Yourself in Short</label>
                                    <textarea class="form-control" wire:model="description">{{ auth()->user()->student->description ?? '' }}</textarea>
                                </div>
{{--                                <div class="form-group smalls">--}}
{{--                                    <label>Biography</label>--}}
{{--                                    <textarea class="form-control summernote"></textarea>--}}
{{--                                </div>--}}
{{--                                <div class="form-group smalls">--}}
{{--                                    <label>Facebook Link</label>--}}
{{--                                    <input type="text" class="form-control" />--}}
{{--                                </div>--}}
{{--                                <div class="form-group smalls">--}}
{{--                                    <label>Twitter Link</label>--}}
{{--                                    <input type="text" class="form-control" />--}}
{{--                                </div>--}}
{{--                                <div class="form-group smalls">--}}
{{--                                    <label>LinkedIn Link</label>--}}
{{--                                    <input type="text" class="form-control" />--}}
{{--                                </div>--}}
{{--                                <div class="form-group smalls">--}}
{{--                                    <label>Gplus Link</label>--}}
{{--                                    <input type="text" class="form-control" />--}}
{{--                                </div>--}}
                                <div class="form-group smalls">
                                    <button class="btn theme-bg text-white" type="submit">Save Change</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-5 col-lg-6 col-md-12">
                <div class="dashboard_wrap">

                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <form action="" method="post" wire:submit="updatePassword()">
                                <div class="form-group smalls">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" required wire:model="current_password"/>
                                </div>
                                <div class="form-group smalls">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" required wire:model="new_password"/>
                                </div>
                                <div class="form-group smalls">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" required wire:model="confirm_password"/>
                                </div>
                                <div class="form-group smalls">
                                    <button class="btn theme-bg text-white" type="submit">Save Change</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
