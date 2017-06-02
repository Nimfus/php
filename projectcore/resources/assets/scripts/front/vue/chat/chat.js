Vue.component('chat-component', {
    template: '#chat',
    mounted: function() {
        this.chatBody = this.$el.querySelector('.body-section');
        this.$http.get('/threads')
            .then(function (response) {
                this.loadUsers(response);
                this.pusher = new Pusher('7dd11caf1030720825d8');
                this.setSubscriptions();
            }, function () {

            }).finally(function () {
            if (this.dialogOpen) {
                this.scrollToEnd();
            }
        });
        this.subscribed = true;
    },
    created: function() {
        var those = this;
        bus.$on('thread-created', function (response) {
            those.users.unshift(response.body.user)
            this.open(response.body.user)
        })
    },
    data: function () {
        return {
            message: '',
            pusher: null,
            messages: {},
            sending: false,
            users: {},
            dialogOpen: false,
            currentUser: null,
            page: 1,
            chatBody: null,
            loading: false,
            hasMoreMessages: true,
            scrollBasePosition: null
        }
    },
    methods: {
        open: function (user) {
            this.dialogOpen = true;
            this.currentUser = user;
            this.loadMessagesHistory();
        },
        close: function() {
            this.dialogOpen = false;
        },
        send: function () {
            if (this.message.length > 0) {
                this.sending = true;
                var those = this;
                this.$http.post('/messages/send', {
                    recipient_id: this.currentUser.id,
                    thread_id: this.currentUser.thread,
                    message: this.message
                }).then(function () {
                    those.message = '';
                    those.sending = false;
                }, function (response) {

                }).finally(function() {
                    this.scrollToEnd();
                    those.$refs.messageField.focus();
                })
            }
        },
        scrollToEnd: function () {
            this.chatBody = this.$el.querySelector('.body-section');
            this.chatBody.scrollTop = this.chatBody.scrollHeight;
        },
        insertMessage: function (thread, message) {
            this.messages[thread].push(message)
        },
        loadMessagesHistory: function () {
            var thread = this.currentUser.thread;
            this.$http.get('/messages/' + thread, {params : {page: this.page}})
                .then(function (response) {
                    Vue.set(this.messages, thread, response.body.messages)
                }, function () {})
                .finally(function () {
                    this.scrollToEnd();
                    this.scrollBasePosition = this.chatBody.scrollHeight;
            });
        },
        loadUsers: function(response) {
            this.users = response.body.users;
        },
        setSubscriptions: function() {
            var those = this;
            var users = this.users;

            for (var i = 0; i < users.length; i++) {
                var thread = users[i].thread;
                Vue.set(this.messages, thread, []);
                this.pusherChannel = this.pusher.subscribe('t-' + thread);
                this.pusherChannel.bind('new-message', function (message) {
                    those.insertMessage(thread, message)
                });
            }
        },
        scroll: function() {
            if (this.chatBody.scrollTop == 0 && this.hasMoreMessages) {
                this.loading = true;
                var thread = this.currentUser.thread;
                this.page++;
                this.$http.get('/messages/' + thread, {params : {page: this.page}})
                    .then(function (response) {
                        this.hasMoreMessages = response.body.messages.length != 0;
                        Vue.set(this.messages, thread, response.body.messages.concat(this.messages[thread]));
                    }, function () {

                    }).finally(function () {
                        this.chatBody.scrollTop = this.chatBody.scrollHeight - this.scrollBasePosition;
                        this.scrollBasePosition = this.chatBody.scrollHeight;
                        this.loading = false;
                });
            }
        }
    },
});