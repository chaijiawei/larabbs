<?php

namespace App\Admin\Controllers;

use App\Models\Reply;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReplyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '回复管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reply());

        $grid->column('id', __('Id'));
        $grid->column('content', __('回复内容'));
        $grid->column('user.name', __('回复用户'));
        $grid->column('topic.title', __('话题'))->display(function($title) {
            return "<a target='_blank' href='" . $this->topic->link() . "'>{$title}</a>";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Reply::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('user_id', __('User id'));
        $show->field('topic_id', __('Topic id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reply());

        $form->textarea('content', __('回复内容'));

        return $form;
    }
}
