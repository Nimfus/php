<script type="text/x-template" id="index">
    <div class="col-xs scroll-box">
        <div class="user-wrapper">
            <div class="user-wrapper__data">
                <div class="name-segment">@{{ user.name }}</div>
                <img class="user-image-segment" :src="'/storage/images/avatars/' + user.avatar">
                <div class="buttons-segment">
                    <v-btn icon="icon" class="red--text" v-on:click.native="like(user.id)">
                        <v-icon>favorite</v-icon>
                    </v-btn>
                    <v-btn icon="icon" class="blue--text" v-on:click.native="chat(user.id)">
                        <v-icon>forum</v-icon>
                    </v-btn>
                    <v-btn icon="icon" class="red--text" v-on:click.native="skip()">
                        <v-icon>clear</v-icon>
                    </v-btn>
                </div>
            </div>
        </div>
    </div>
</script>