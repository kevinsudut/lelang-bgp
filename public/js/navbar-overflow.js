"use strict";
(function (NavbarOverflow) {
    $(document).ready(function () {
        $(window).on('resize', function () {
            NavbarOverflow.reset()
            if (!NavbarOverflow.check()) {
                return
            }
            NavbarOverflow.remove()
            NavbarOverflow.create()
        })

        $('span.menu-responsive').click(function (e) {
            $(e.currentTarget)
                .children('.sub-menu-container-small')
                .toggle()

            if (
                $(e.currentTarget)
                .children('.sub-menu-container-small')
                .hasClass('d-inline-block')
            ) {
                $(e.currentTarget)
                    .children('.sub-menu-container-small')
                    .removeClass('d-inline-block')
            } else {
                $(e.currentTarget)
                    .children('.sub-menu-container-small')
                    .addClass('d-inline-block')
            }
        })

        $(document).on('click', '.sub-menu-container .menu', function (e) {
            $(e.currentTarget)
                .children('.second-level-menu-container')
                .toggle()
        })

        if (!NavbarOverflow.check()) {
            return
        }

        NavbarOverflow.remove()
        NavbarOverflow.create()
    })
})({
    overflowed: [],
    more: $(
        `<span class='menu'>
            <a href='#'>More <i class='fas fa-caret-down'></i></a>
            <div class='sub-menu-container more'></div>
        </span>`
    ),
    check: function () {
        const {
            clientWidth,
            clientHeight,
            scrollWidth,
            scrollHeight
        } = $('.navbar-scroll')[0]
        return scrollHeight > clientHeight || scrollWidth > clientWidth
    },
    remove: function () {
        const children = $('.navbar-scroll').children()
        this.overflowed = []
        let overflow = this.check()
        while (this.check()) {
            let temp = children.splice(children.length - 1, 1)[0]
            this.overflowed.push(temp)
            $(temp).remove()
        }
        if (overflow) {
            let temp = children.splice(children.length - 1, 1)[0]
            this.overflowed.push(temp)
            $(temp).remove()
        }
        let last = children.splice(children.length - 1, 1)[0]
        this.overflowed.push(last)
        $(last).remove()
    },
    reset: function () {
        for (let i = this.overflowed.length - 1; i >= 0; i--) {
            $(this.overflowed[i])
                .find('.second-level-menu-container')
                .removeAttr('style')
                .addClass('sub-menu-container')
                .removeClass('second-level-menu-container')
            $('.navbar-scroll').append(this.overflowed[i])
        }
        this.more.remove()
        this.overflowed = []
    },
    create: function () {
        $('.navbar-scroll').append(this.more)
        const moreSubMenu = this.more.find('.sub-menu-container')
        for (let i = this.overflowed.length - 1; i >= 0; i--) {
            const el = $(this.overflowed[i])
            el.find('.sub-menu-container')
                .addClass('second-level-menu-container')
                .removeClass('sub-menu-container')
            moreSubMenu.append(el)
        }
    },
})
