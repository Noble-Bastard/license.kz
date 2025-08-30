@extends('layouts.figma-app')

@section('content')
<div class="w-full">
    <!-- Page Content -->
    <div class="px-5 py-5" style="padding-left: 20px; padding-right: 20px;">
        <div class="px-5" style="padding-left: 20px; padding-right: 20px;">
            <!-- Page Header -->
            <div class="mb-[35px]">
                <div class="mb-[30px]">
                    <div class="flex items-center justify-between gap-[10px]">
                        <!-- Page Title -->
                        <h1 class="text-4xl font-normal leading-[1] text-black" style="font-size: 39px; letter-spacing: -0.02em;">
                            Исполнители
                        </h1>

                        <!-- Search -->
                        <div class="flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[60px]">
                            <!-- Search icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8333 15.8333L13.2083 13.2083" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="text" 
                                   placeholder="Поиск по номеру услуги или компании" 
                                   class="bg-transparent border-none outline-none text-xs font-medium leading-[1] text-text-primary placeholder-text-primary"
                                   style="font-size: 12px;">
                        </div>
                    </div>
                </div>

                <!-- Table Header -->
                <div class="h-[12px] relative">
                    <div class="flex items-center w-full absolute">
                        <!-- Column headers -->
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 113px; margin-top: -2px;">
                            Имя исполнителя
                        </div>
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 139px; margin-left: 279px; margin-top: -2px;">
                            E-mail
                        </div>
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 139px; margin-left: 478px; margin-top: -2px;">
                            Телефон
                        </div>
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 115px; margin-left: 645px; margin-top: -2px;">
                            Группы
                        </div>
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 97px; margin-left: 1058px; margin-top: -2px;">
                            Ставка в час, ₸
                        </div>
                        <div class="text-xs font-semibold text-text-muted leading-[1]" style="width: 113px; margin-left: 1204px; margin-top: -2px;">
                            Активность
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Executors Cards Section -->
        <div class="flex flex-col items-center gap-[15px] px-5 pb-[30px] pt-[10px]" style="padding-left: 20px; padding-right: 20px;">
            <div class="flex flex-col gap-[50px] pt-[3px] w-full">
                <div class="flex flex-col gap-[10px] pb-[10px] w-full">
                    
                    <!-- Executor Card 1 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Иван Иванов
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Executor Card 2 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1" style="width: 139px;">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Альберт Фасхутдинов
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Executor Card 3 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Андрей Булава
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Executor Card 4 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Владимир Епифанцев
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Executor Card 5 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Никита Кологривый
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Executor Card 6 -->
                    <div class="bg-bg-primary rounded-lg p-5 shadow-sm">
                        <div class="flex items-center gap-[30px] w-full">
                            <!-- Name with Avatar -->
                            <div class="flex items-center gap-[10px]" style="width: 251px;">
                                <div class="w-[26px] h-[26px] rounded-full bg-gray-300"
                                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjYiIHZpZXdCb3g9IjAgMCAyNiAyNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI2IiBoZWlnaHQ9IjI2IiByeD0iMTMiIGZpbGw9IiNGNUY1RjUiLz4KPHN2ZyB4PSI1IiB5PSI1IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSI+CjxwYXRoIGQ9Ik04IDhDOS42NTY4NSA4IDExIDYuNjU2ODUgMTEgNUMxMSAzLjM0MzE1IDkuNjU2ODUgMiA4IDJDNi4zNDMxNSAyIDUgMy4zNDMxNSA1IDVDNSA2LjY1Njg1IDYuMzQzMTUgOCA4IDhaIiBmaWxsPSIjOTQ5NEE0Ii8+CjxwYXRoIGQ9Ik0xNCA5SDE0QzE0IDEwLjEgMTMuMSAxMSAxMiAxMUg0QzIuOSAxMSAyIDEwLjEgMiA5SDJDMiA5IDIgOSAyIDlINEM0IDkgNC40IDguNiA1IDhINUg3SDlIMTFDMTEuNiA4LjYgMTIgOSAxMiA5SDE0WiIgZmlsbD0iIzk0OTRBNCIvPgo8L3N2Zz4KPC9zdmc+'); background-size: cover;">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-text-secondary leading-[1]">
                                        Илья Терехин
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 167px;">
                                email@example.ru
                            </div>

                            <!-- Phone -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 137px;">
                                +7 880 765 67 78
                            </div>

                            <!-- Groups -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 385px;">
                                Строительство, Строительство г. Караганда, транспорт ...
                            </div>

                            <!-- Rate -->
                            <div class="text-sm font-medium text-text-secondary leading-[1]" style="width: 60px;">
                                140
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-end gap-[60px]" style="width: 111px;">
                                <div class="flex items-center justify-center gap-[10px]">
                                    <div class="w-2 h-2 rounded-full bg-status-online"></div>
                                    <span class="text-sm font-medium text-text-secondary leading-[1]">В сети</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


