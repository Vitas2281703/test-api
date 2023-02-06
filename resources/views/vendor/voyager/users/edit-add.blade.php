@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Имя"
                                       value="{{ old('name', $dataTypeContent->name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan
                            <div class="form-group">
                                <label for="login">Логин</label>
                                @if(isset($dataTypeContent->login))
                                    <br>
                                @endif
                                <input type="text" class="form-control" id="login" name="login" value="{{ old('login', $dataTypeContent->login ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="city">Город</label>
                                @if(isset($dataTypeContent->city))
                                    <br>
                                @endif
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $dataTypeContent->city  ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="city">О себе</label>
                                @if(isset($dataTypeContent->about))
                                    <br>
                                @endif
                                <textarea class="form-control" id="about" name="about">{{ old('about', $dataTypeContent->about  ?? '') }}</textarea>
                            </div>
                            @php
                                if (isset($dataTypeContent->type)) {
                                    $selected_type = $dataTypeContent->type;
                                }
                            @endphp
                            <div class="form-group">
                                <label for="type">Тип</label>
                                <select class="form-control select2" id="type" name="type">

                                    <option value="" @if(!isset($selected_type)) selected @endif>
                                        Не выбран</option>
                                    <option value="{{ App\Domain\Enums\Users\Type::BACK }}"
                                            @if(isset($selected_type) && $selected_type == App\Domain\Enums\Users\Type::BACK )
                                                selected @endif>
                                        {{ App\Domain\Enums\Users\Type::BACK }}
                                    </option>
                                    <option value="{{ App\Domain\Enums\Users\Type::FRONT }}"
                                            @if(isset($selected_type) && $selected_type == App\Domain\Enums\Users\Type::FRONT )
                                                selected @endif>
                                        {{ App\Domain\Enums\Users\Type::FRONT }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="github">Github</label>
                                @if(isset($dataTypeContent->github))
                                    <br>
                                @endif
                                <input type="text" class="form-control" id="gtihub" name="github" value="{{ old('github', $dataTypeContent->github  ?? '') }}">
                            </div>


                            <div class="form-group">
                                <label for="is_finished">Выполнение</label>
                                <select class="form-control select2" id="is_finished" name="is_finished">

                                    <option value="0" @if($dataTypeContent->is_finished === false)
                                        selected @endif>
                                        Не выполнено</option>
                                    <option value="1" @if($dataTypeContent->is_finished === true)
                                        selected @endif>
                                        Выполнено</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                @if(isset($dataTypeContent->phone))
                                    <br>
                                @endif
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $dataTypeContent->phone  ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="telegram">Telegram</label>
                                @if(isset($dataTypeContent->telegram))
                                    <br>
                                @endif
                                <input type="text" class="form-control" id="telegram" name="telegram" value="{{ old('telegram', $dataTypeContent->telegram  ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="telegram">Дата рождения</label>
                                @if(isset($dataTypeContent->birthday))
                                    <br>
                                @endif
                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', $dataTypeContent->birthday  ?? '') }}">
                            </div>
                            @php
                            if (isset($dataTypeContent->locale)) {
                                $selected_locale = $dataTypeContent->locale;
                            } else {
                                $selected_locale = config('app.locale', 'en');
                            }

                            @endphp
                            <div class="form-group">
                                <label for="locale">{{ __('voyager::generic.locale') }}</label>
                                <select class="form-control select2" id="locale" name="locale">
                                    @foreach (Voyager::getLocales() as $locale)
                                    <option value="{{ $locale }}"
                                    {{ ($locale == $selected_locale ? 'selected' : '') }}>{{ $locale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
            <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
