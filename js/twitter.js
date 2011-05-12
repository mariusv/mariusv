    $(document).ready(function(){
        $(".tweet").tweet({
            username: "abisdemon",
            join_text: "auto",
            avatar_size: 32,
            count: 3,
            auto_join_text_default: "I said,", 
            auto_join_text_ed: "I",
            auto_join_text_ing: "I was",
            auto_join_text_reply: "I replied to",
            auto_join_text_url: "I was checking out",
            loading_text: "loading tweets..."
        });
    });
