<div class="dropdown relative">
    <div class="dropdown__btn">
        <button type="button"
                class="transition-all duration-200 hover:text-blue flex items-center justify-center text-gray relative">
            <i class="absolute pointer-events-none -right-2 -top-2 w-4 h-4 font-semibold not-italic bg-red flex items-center justify-center text-white rounded-full"
               style="font-size: 10px">{{ $notifications->count() }}</i>
            <svg class="icon">
                <use xlink:href="../images/symbols.svg#push"></use>
            </svg>
        </button>
    </div>
    <div
        class="dropdown__inner push origin-top-right absolute left-0 mt-2 w-80 rounded-xl shadow bg-white opacity-0 invisible z-100"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-3 px-4 flex items-center justify-between" role="none">
            <b class="text-sm">Уведомления</b>
            <a href="javascript:;" class="text-gray text-xs font-semibold transition-all duration-200 hover:text-blue">Очистить</a>
        </div>
        <div class="push__body" style="height: 230px;" ss-container>
            @foreach($notifications as $notification)
                <div
                    class="push__item w-full flex items-start py-4 px-4 hover:bg-gray/[0.05] transition-all duration-200">
                    <div
                        class="push__ico w-8 h-8 rounded-full bg-green-light/[0.2] flex items-center justify-center text-green-light mr-3">
                        <svg class="icon w-4 h-4">
                            <use xlink:href="../images/symbols.svg#success"></use>
                        </svg>
                    </div>
                    <div class="push__info flex flex-col pt-0.5">
                        <b class="text-xs font-bold pb-1 leading-relaxed">{{ config('activitylog.subjects_title.' . $notification->subject_type) }}</b>
                        <p class="text-xs font-semibold text-gray leading-relaxed">{{ $notification->description }}</p>
                        <div class="flex items-center text-xs text-gray font-semibold mt-1.5">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                 width="14" height="14" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <g fill="currentColor">
                                    <path
                                        d="M13 5.07A7.002 7.002 0 0 1 12 19A7 7 0 0 1 7.262 6.847L5.847 5.432A9 9 0 1 0 11 3.055v6.03h2V5.072Z"/>
                                    <path
                                        d="M7.707 8.707a1 1 0 0 0 0 1.414l2.829 2.829a1 1 0 0 0 1.414-1.414L9.12 8.707a1 1 0 0 0-1.414 0Z"/>
                                </g>
                            </svg>
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
