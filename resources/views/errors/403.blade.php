@extends('errors::minimal')

@section('title', __('403 | Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
