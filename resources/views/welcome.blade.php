<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script>
            window.Components = {
                listbox: e=>({
                    init() {
                        this.optionCount = this.$refs.listbox.children.length,
                        this.$watch("activeIndex", (e=>{
                            this.open && (null !== this.activeIndex ? this.activeDescendant = this.$refs.listbox.children[this.activeIndex].id : this.activeDescendant = "")
                        }
                        ))
                    },
                    activeDescendant: null,
                    optionCount: null,
                    open: !1,
                    activeIndex: null,
                    selectedIndex: 0,
                    get active() {
                        return this.items[this.activeIndex]
                    },
                    get[e.modelName || "selected"]() {
                        return this.items[this.selectedIndex]
                    },
                    choose(e) {
                        this.selectedIndex = e,
                        this.open = !1
                    },
                    onButtonClick() {
                        this.open || (this.activeIndex = this.selectedIndex,
                        this.open = !0,
                        this.$nextTick((()=>{
                            this.$refs.listbox.focus(),
                            this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                                block: "nearest"
                            })
                        }
                        )))
                    },
                    onOptionSelect() {
                        null !== this.activeIndex && (this.selectedIndex = this.activeIndex),
                        this.open = !1,
                        this.$refs.button.focus()
                    },
                    onEscape() {
                        this.open = !1,
                        this.$refs.button.focus()
                    },
                    onArrowUp() {
                        this.activeIndex = this.activeIndex - 1 < 0 ? this.optionCount - 1 : this.activeIndex - 1,
                        this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                            block: "nearest"
                        })
                    },
                    onArrowDown() {
                        this.activeIndex = this.activeIndex + 1 > this.optionCount - 1 ? 0 : this.activeIndex + 1,
                        this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                            block: "nearest"
                        })
                    },
                    ...e
                })
            },
            window.Components.popoverGroup = function() {
                return {
                    __type: "popoverGroup",
                    init() {
                        let e = t=>{
                            document.body.contains(this.$el) ? t.target instanceof Element && !this.$el.contains(t.target) && window.dispatchEvent(new CustomEvent("close-popover-group",{
                                detail: this.$el
                            })) : window.removeEventListener("focus", e, !0)
                        }
                        ;
                        window.addEventListener("focus", e, !0)
                    }
                }
            }
            ,
            window.Components.popover = function({open: e=!1, focus: t=!1}={}) {
                const n = ["[contentEditable=true]", "[tabindex]", "a[href]", "area[href]", "button:not([disabled])", "iframe", "input:not([disabled])", "select:not([disabled])", "textarea:not([disabled])"].map((e=>`${e}:not([tabindex='-1'])`)).join(",");
                return {
                    __type: "popover",
                    open: e,
                    init() {
                        t && this.$watch("open", (e=>{
                            e && this.$nextTick((()=>{
                                !function(e) {
                                    const t = Array.from(e.querySelectorAll(n));
                                    !function e(n) {
                                        void 0 !== n && (n.focus({
                                            preventScroll: !0
                                        }),
                                        document.activeElement !== n && e(t[t.indexOf(n) + 1]))
                                    }(t[0])
                                }(this.$refs.panel)
                            }
                            ))
                        }
                        ));
                        let e = n=>{
                            if (!document.body.contains(this.$el))
                                return void window.removeEventListener("focus", e, !0);
                            let i = t ? this.$refs.panel : this.$el;
                            if (this.open && n.target instanceof Element && !i.contains(n.target)) {
                                let e = this.$el;
                                for (; e.parentNode; )
                                    if (e = e.parentNode,
                                    e.__x instanceof this.constructor) {
                                        if ("popoverGroup" === e.__x.$data.__type)
                                            return;
                                        if ("popover" === e.__x.$data.__type)
                                            break
                                    }
                                this.open = !1
                            }
                        }
                        ;
                        window.addEventListener("focus", e, !0)
                    },
                    onEscape() {
                        this.open = !1,
                        this.restoreEl && this.restoreEl.focus()
                    },
                    onClosePopoverGroup(e) {
                        e.detail.contains(this.$el) && (this.open = !1)
                    },
                    toggle(e) {
                        this.open = !this.open,
                        this.open ? this.restoreEl = e.currentTarget : this.restoreEl && this.restoreEl.focus()
                    }
                }
            }
            ,
            window.Components.radioGroup = function({initialCheckedIndex: e=0}={}) {
                return {
                    value: void 0,
                    init() {
                        this.value = Array.from(this.$el.querySelectorAll("input"))[e]?.value
                    }
                }
            }
            ;

        </script>

    </head>
    <body class="font-sans antialiased">
        <div class="" style="">
            <div class="relative">

                {{-- Navbar --}}
                <div class="relative bg-white shadow" x-data="Components.popover({ open: false, focus: true })" x-init="init()" @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6">
                        <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
                            <div class="flex justify-start lg:w-0 lg:flex-1">
                                <a href="#">
                                <span class="sr-only">Workflow</span>
                                <svg class="h-8 w-auto sm:h-10 text-warm-gray-700" stroke="currentColor" fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 500 500" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M14.1,445.8v-59.7h47.4v16.6H33.3v9h21.3v15.4H33.3v18.8H14.1z"/>
                                            <path d="M78.9,445.8v-59.7h19.2v59.7H78.9z"/>
                                            <path d="M119.5,445.8v-59.7h29.4c6.5,0,11.9,2,16.2,6.1c4.3,4.1,6.4,9.2,6.4,15.2c0,5.1-1.6,9.4-4.7,13.1c-1.4,1.6-3,2.9-4.7,3.9
                                                l11.5,21.3h-20.1l-8.5-17.1h-6.4v17.1H119.5z M138.7,412.6h8.1c1.7,0,3.1-0.5,4.1-1.4c1-0.9,1.5-2.2,1.5-3.7
                                                c0-1.5-0.5-2.8-1.5-3.7c-1-0.9-2.3-1.4-4.1-1.4h-8.1V412.6z"/>
                                            <path d="M190.3,445.8v-59.7h47.4v15.8h-28.2v7.3h21.3v13.7h-21.3v7.3h29v15.8H190.3z"/>
                                            <path d="M256.8,445.8v-59.7h19.2v41.8h24.7v17.9H256.8z"/>
                                            <path d="M317.4,445.8v-59.7h19.2v59.7H317.4z"/>
                                            <path d="M358,445.8v-59.7h16.6l22.2,28.6v-28.6H416v59.7h-16.6l-22.2-28.6v28.6H358z"/>
                                            <path d="M437.3,445.8v-59.7h47.4v15.8h-28.2v7.3h21.3v13.7h-21.3v7.3h29v15.8H437.3z"/>
                                        </g>
                                        <polyline points="258,362.3 484.9,362.3 484.9,269.8 357.1,269.8 357.1,54 258,54 258,54 13.6,54 13.6,362.3 112.7,362.3 
                                            112.7,265.4 211.9,265.4 211.9,186.1 112.7,186.1 112.7,139.9 258,139.9 	"/>
                                    </g>
                                </svg>
                                </a>
                            </div>

                            <div class="-mr-2 -my-2 md:hidden">
                                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                                <span class="sr-only">Open menu</span>
                                <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                </button>
                            </div>

                            <nav class="hidden md:flex space-x-10" x-data="Components.popoverGroup()" x-init="init()">
                                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                                Pricing
                                </a>
                                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                                Docs
                                </a>
                            </nav>

                            <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                                @if (Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                        @auth
                                            <a href="{{ route('dashboard') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-600 hover:bg-orange-700">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                                                Sign in
                                            </a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-600 hover:bg-orange-700">
                                                    Sign up
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
            
                    <div x-show="open" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" x-description="Mobile menu, show/hide based on mobile menu state." class="absolute top-0 inset-x-0 z-10 p-2 transition transform origin-top-right md:hidden" x-ref="panel" @click.away="open = false" style="display: none;">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                            <div class="pt-5 pb-6 px-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <svg class="h-8 w-auto sm:h-10 text-warm-gray-700" stroke="currentColor" fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 500 500" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M14.1,445.8v-59.7h47.4v16.6H33.3v9h21.3v15.4H33.3v18.8H14.1z"/>
                                            <path d="M78.9,445.8v-59.7h19.2v59.7H78.9z"/>
                                            <path d="M119.5,445.8v-59.7h29.4c6.5,0,11.9,2,16.2,6.1c4.3,4.1,6.4,9.2,6.4,15.2c0,5.1-1.6,9.4-4.7,13.1c-1.4,1.6-3,2.9-4.7,3.9
                                                l11.5,21.3h-20.1l-8.5-17.1h-6.4v17.1H119.5z M138.7,412.6h8.1c1.7,0,3.1-0.5,4.1-1.4c1-0.9,1.5-2.2,1.5-3.7
                                                c0-1.5-0.5-2.8-1.5-3.7c-1-0.9-2.3-1.4-4.1-1.4h-8.1V412.6z"/>
                                            <path d="M190.3,445.8v-59.7h47.4v15.8h-28.2v7.3h21.3v13.7h-21.3v7.3h29v15.8H190.3z"/>
                                            <path d="M256.8,445.8v-59.7h19.2v41.8h24.7v17.9H256.8z"/>
                                            <path d="M317.4,445.8v-59.7h19.2v59.7H317.4z"/>
                                            <path d="M358,445.8v-59.7h16.6l22.2,28.6v-28.6H416v59.7h-16.6l-22.2-28.6v28.6H358z"/>
                                            <path d="M437.3,445.8v-59.7h47.4v15.8h-28.2v7.3h21.3v13.7h-21.3v7.3h29v15.8H437.3z"/>
                                        </g>
                                        <polyline points="258,362.3 484.9,362.3 484.9,269.8 357.1,269.8 357.1,54 258,54 258,54 13.6,54 13.6,362.3 112.7,362.3 
                                            112.7,265.4 211.9,265.4 211.9,186.1 112.7,186.1 112.7,139.9 258,139.9 	"/>
                                    </g>
                                </svg>
                                </div>
                                <div class="-mr-2">
                                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" @click="toggle">
                                    <span class="sr-only">Close menu</span>
                                    <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                </div>
                            </div>
                            <div class="mt-6">
                                <nav class="grid gap-y-8">
                                
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                        <svg class="flex-shrink-0 h-6 w-6 text-orange-600" x-description="Heroicon name: outline/chart-bar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span class="ml-3 text-base font-medium text-gray-900">
                                            Analytics
                                        </span>
                                    </a>
                                
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                        <svg class="flex-shrink-0 h-6 w-6 text-orange-600" x-description="Heroicon name: outline/cursor-click" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                                        </svg>
                                        <span class="ml-3 text-base font-medium text-gray-900">
                                            Engagement
                                        </span>
                                    </a>
                                
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <svg class="flex-shrink-0 h-6 w-6 text-orange-600" x-description="Heroicon name: outline/shield-check" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">
                                        Security
                                    </span>
                                    </a>
                                
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <svg class="flex-shrink-0 h-6 w-6 text-orange-600" x-description="Heroicon name: outline/view-grid" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">
                                        Integrations
                                    </span>
                                    </a>
                                
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <svg class="flex-shrink-0 h-6 w-6 text-orange-600" x-description="Heroicon name: outline/refresh" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">
                                        Automations
                                    </span>
                                    </a>
                                </nav>
                            </div>
                            </div>
                            <div class="py-6 px-5 space-y-6">
                            <div>
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-600 hover:bg-orange-700">
                                Sign up
                                </a>
                                <p class="mt-6 text-center text-base font-medium text-gray-500">
                                Existing account?
                                <a href="#" class="text-orange-600 hover:text-orange-500">
                                    Sign in
                                </a>
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- Content --}}
                <main class="lg:relative bg-warm-gray-700 text-warm-gray-100">
                    <div class="mx-auto max-w-7xl w-full pt-16 pb-20 text-center lg:py-48 lg:text-left">
                        <div class="px-4 lg:w-1/2 sm:px-8 xl:pr-16">
                            <h1 class="text-4xl tracking-tight font-extrabold text-warm-gray-100 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                                <span class="block xl:inline">Simplify your appliance</span>
                                <!-- space -->
                                <span class="block text-orange-500 xl:inline">logs and checks.</span>
                            </h1>

                            <p class="mt-3 max-w-md mx-auto text-lg text-warm-gray-400 sm:text-xl md:mt-5 md:max-w-3xl">
                                Tablet based appliance management.
                            </p>
                            
                            <div class="mt-10 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-warm-gray-100 bg-orange-600 hover:bg-orange-700 md:py-4 md:text-lg md:px-10">
                                        Get started
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-64 sm:h-72 md:h-96 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:h-full">
                        <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1615092296061-e2ccfeb2f3d6?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="">
                    </div>
                </main>

            </div>
        </div>
    </body>
</html>
