<template>
    <div>
        <div class="card">
            <div class="card-header">
                Header
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active">
                                <div class="list-content">
                                    <img src="/img/person.jpg" alt="User" class="chat-image">
                                    <div class="person-details">
                                        <div class="chat-name">Alain MUCYO</div>
                                        <div class="chat-type">Seller</div>
                                    </div>
                                </div>
                            </a> <a href="#" class="list-group-item list-group-item-action">
                            <div class="list-content">
                                <img src="/img/person.jpg" alt="User" class="chat-image">
                                <div class="person-details">
                                    <div class="chat-name">Alain MUCYO</div>
                                    <div class="chat-type">Seller</div>
                                </div>
                            </div>
                        </a> <a href="#" class="list-group-item list-group-item-action">
                            <div class="list-content">
                                <img src="/img/person.jpg" alt="User" class="chat-image">
                                <div class="person-details">
                                    <div class="chat-name">Alain MUCYO</div>
                                    <div class="chat-type">Seller</div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="chatbox__container">
                            <div class="chatbox">
                                <img src="/img/person.jpg" alt="User" class="chatbox__image">
                                <div class="chatbox__content">
                                    <div class="chatbox--name">Alain MUCYO</div>
                                    <div class="chatbox--message">
                                        Hello! How are you doing??
                                    </div>
                                </div>
                                <div class="chatbox--date text-muted">2 days ago</div>
                            </div>
                        </div>
                        <div class="chatbox__form">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
<!--                                        <input type="textarea" class="form-control" placeholder="Type message here....">-->
                                        <textarea name="" rows="2" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-2">
                                       <button class="btn btn-solid">Send</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatBox"
    }
</script>

<style scoped>
    .chatbox {
        display: flex;
        align-items: stretch;
        margin-bottom: 1.25rem;
        padding: .5rem .55rem;
    }

    .chatbox__content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: #404040;
        margin-right: auto;
    }

    .chatbox__image {
        height: 2.75rem;
        border-radius: 50%;
        margin-right: .90rem;
    }

    .chatbox--name {
        font-size: 85%;
        font-weight: 900;
    }

    .chatbox--date {
        align-self: center;
        /*color: #6a6a6a;*/
    }

    .list-content {
        display: flex;
        align-items: center;
    }

    .list-group-item.active .person-details {
        display: flex;
        flex-direction: column;
        color: #fff;
    }

    .list-group-item .person-details {
        display: flex;
        flex-direction: column;
        color: #797979;
    }

    .chat-type {
        font-size: 70%;
        text-transform: uppercase;

    }

    .chat-image {
        height: 3rem;
        border-radius: 50%;
        margin-right: .95rem;
    }

    .card {
        border-radius: 3px;
        border: solid #f6f6f6 1px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, .1);
    }

    .card-body {
        padding: 2rem 10px;
    }

    .list-group {
        border-radius: 2px;
    }

    .list-group-item:first-child, .list-group-item:last-child {
        border-radius: 2px;
    }

    .list-group-item {
        transition: all .2s;
    }

    .list-group-item.active:hover {
        background-color: #006bdd;
    }

    .list-group-item:hover {
        background-color: #f6f6f6;
    }

    .list-group-item:active {
        background-color: #fff;
    }
    textarea{
        resize: none;
    }
</style>
