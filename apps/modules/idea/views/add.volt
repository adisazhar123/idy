{% extends 'layout.volt' %}

{% block title %}Add New Idea{% endblock %}

{% block styles %}

{% endblock %}

{% block content %}

<div class="idea">
    <div class="card">
        <div class="card-body">
            <form action="/add" method="POST">
                <div class="form-group">
                    <label for="">Idea Title</label>
                    <input type="text" class="form-control" name="ideaTitle">
                    <label for="">Idea Description</label>
                    <textarea name="ideaDescription" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Author Name</label>
                    <input type="text" class="form-control" name="authorName">
                    <label for="">Author Email</label>
                    <input type="text" name="authorEmail" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

{% endblock %}

{% block scripts %}

{% endblock %}