<script type="text/x-template" id="chat">
        <div class="chat-widget">
            <transition name="slide-fade" v-on:after-enter="scrollToEnd">
                <div class="chat" v-if="dialogOpen">
                    <div class="header-section">
                        <div class="avatar" v-if="currentUser != null"
                             v-bind:style="{ backgroundImage: 'url(/storage/images/avatars/' + currentUser.avatar + ')' }">
                        </div>
                        <p class="user-name" v-if="currentUser != null">@{{ currentUser.name }}</p>
                        <i class="material-icons icon" v-on:click="close()">clear</i>
                    </div>
                    <div class="body-section" v-on:scroll="scroll()">
                        <div class="messages-loader" v-if="loading">
                            <v-progress-circular indeterminate v-bind:size="25" class="primary--text"/>
                        </div>

                        <div v-for="message in messages[currentUser.thread]">
                            <div class="message-body">
                                <div class="avatar">

                                </div>
                                <div class="message">
                                    <p>@{{ message.message }}</p>
                                </div>
                                <div class="time">
                                    <p v-time="message.created_at">@{{ message.created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-section">
                        <div class="icons-section">
                            <v-btn primary floating small dark class="sub-icon">
                                <i class="fa fa-smile-o"></i>
                            </v-btn>
                            <v-btn primary floating small dark class="sub-icon">
                                <i class="fa fa-gift"></i>
                            </v-btn>
                        </div>
                        <textarea v-model="message" v-on:keyup.enter="send()" :disabled="sending" ref="messageField"></textarea>
                        <div class="button-div">
                            <v-btn small primary v-bind:loading="sending"
                                   v-on:click.native="send()" v-bind:disabled="sending">
                                <v-icon>send</v-icon>
                                {{--<i class="fa fa-send"></i>--}}
                            </v-btn>
                        </div>
                    </div>
                </div>
            </transition>
            <div class="contacts">
                <div class="user" v-for="user in users" v-badge="{ value: 2, overlap: true }"
                     v-on:click="open(user)"
                     v-bind:style="{ backgroundImage: 'url(/storage/images/avatars/' + user.avatar + ')' }"
                     v-tooltip="user.name">
                </div>
            </div>
        </div>
</script>