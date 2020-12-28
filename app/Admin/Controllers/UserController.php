<?php

namespace App\Admin\Controllers;

use App\Models\Role;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('avatar', __('用户头像'))->image('', 50, 50);
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('roles', '角色')->display(function($roles) {
            return collect($roles)->implode('name', ' | ');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('avatar', __('Avatar'));
        $show->field('intro', __('Intro'));
        $show->field('notify_count', __('Notify count'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'))->rules(function(Form $form) {
            if(!$form->model()->id) {
                return [
                    'required',
                    'min:8',
                    'confirmed',
                ];
            } else {
                return [
                    'nullable',
                    'min:8',
                    'confirmed',
                ];
            }
        });
        $form->password('password_confirmation', '确认密码');
        $form->multipleSelect('roles', '角色')->options(function($ids) {
            return Role::all()->pluck('name', 'id');
        });
        $form->image('avatar', __('Avatar'));
        $form->text('intro', __('Intro'));

        //保存前回调
        $form->submitted(function (Form $form) {
            if($form->model()->id &&
                !request()->password) {
                $form->ignore('password');
            }
            $form->ignore('password_confirmation');
        });

        return $form;
    }
}
