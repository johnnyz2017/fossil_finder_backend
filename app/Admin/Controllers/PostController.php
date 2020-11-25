<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('auth_user_id', __('Auth user id'));
        $grid->column('temp_id', __('Temp id'));
        $grid->column('perm_id', __('Perm id'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('private', __('Private'));
        $grid->column('published', __('Published'));
        $grid->column('images', __('Images'));
        $grid->column('category_id', __('Category id'));
        // $grid->column('final_category_id', __('Final category id'));
        // $grid->column('final_category_id_from', __('Final category id from'));
        $grid->column('coordinate_longitude', __('Longitude'));
        $grid->column('coordinate_latitude', __('Latitude'));
        $grid->column('coordinate_altitude', __('Altitude'));
        $grid->column('address', __('Address'));
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('auth_user_id', __('Auth user id'));
        $show->field('temp_id', __('Temp id'));
        $show->field('perm_id', __('Perm id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('private', __('Private'));
        $show->field('published', __('Published'));
        $show->field('images', __('Images'));
        $show->field('category_id', __('Category id'));
        $show->field('final_category_id', __('Final category id'));
        $show->field('final_category_id_from', __('Final category id from'));
        $show->field('coordinate_longitude', __('Coordinate longitude'));
        $show->field('coordinate_latitude', __('Coordinate latitude'));
        $show->field('coordinate_altitude', __('Coordinate altitude'));
        $show->field('address', __('Address'));
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
        $form = new Form(new Post());

        $form->number('user_id', __('User id'));
        $form->number('auth_user_id', __('Auth user id'));
        $form->text('temp_id', __('Temp id'));
        $form->text('perm_id', __('Perm id'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->switch('private', __('Private'));
        $form->switch('published', __('Published'));
        $form->textarea('images', __('Images'));
        $form->number('category_id', __('Category id'));
        $form->number('final_category_id', __('Final category id'));
        $form->number('final_category_id_from', __('Final category id from'));
        $form->decimal('coordinate_longitude', __('Coordinate longitude'));
        $form->decimal('coordinate_latitude', __('Coordinate latitude'));
        $form->decimal('coordinate_altitude', __('Coordinate altitude'));
        $form->text('address', __('Address'));

        return $form;
    }
}
