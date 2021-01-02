<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class TopicController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '话题管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic());

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'))->display(function($title) {
            return "<a target='_blank' href='" . $this->link() . "'>$title</a>";
        });
        $grid->column('body', __('内容'))->display(function($content) {
            return Str::limit($content, 50);
        });
        $grid->column('category.name', __('分类'));
        $grid->column('user.name', __('用户'));
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
        $show = new Show(Topic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('body', __('Body'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('excerpt', __('Excerpt'));
        $show->field('slug', __('Slug'));
        $show->field('reply_count', __('Reply count'));
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
        $form = new Form(new Topic());

        $form->text('title', __('Title'));
        $form->textarea('body', __('Body'));
        $form->select('category_id', __('分类'))->options(function() {
            return Category::all()->pluck('name', 'id');
        });
//        $form->number('user_id', __('User id'));

        return $form;
    }
}
