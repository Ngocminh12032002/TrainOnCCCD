<div id="aside-right" class="aside-right">
    <div class="sidebar">
        <div class="sidebarBody" style="overflow-y: scroll">
            <div class="container">
                <div class="row">
                    <div
                        class="sidebarBody_heading-wrapper mb-3  mt-3 d-flex align-items-center justify-content-between">
                        <h6 class="sidebarBody_heading-big m-0">
                            Tổng quan đơn vị
                        </h6>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#neuvande">Nêu vấn
                            đề</button>
                    </div>
                    @if(env('FE_LAYOUT'))

                    <div class="sidebarBody_wrapper">
                        <div class="sidebarBody_card" style="line-height: 26px; height: 200px; overflow-y: scroll">
                            <div class="sidebarBody_heading-wrapper">
                                <h6 class="sidebarBody_heading">Chỉ số công việc đơn vị</h6>
                            </div>
                            @include('template.components.KeyIndex.elementCardMini')
                        </div>
                    </div>
                    
                    <div class="sidebarBody_wrapper mt-4">
                        <div class="sidebarBody_card bg-pink-blur">
                            {{-- Sỹ số --}}
                            @include('template.components.KeyIndex.elementCardThree', ['heading' => 'Sỹ số', 'title_today' => 'Vắng', 'title_week' => 'Công tác', 'title_month' => 'Mới', 'today_completed' => '2', 'week_completed' => '3','month_completed' => '4', 'icon' => 'bi-person-lines-fill'])
    
                            {{-- Số vi phạm hành chính --}}
                            @include('template.components.KeyIndex.elementCardThree', ['heading' => 'Số vi phạm hành chính', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'week_completed' => '3','month_completed' => '4', 'color' => 'text-danger', 'icon' => 'bi-radioactive'])
    
                            {{-- Số vi phạm nghiệp vụ --}}
                            @include('template.components.KeyIndex.elementCardThree', ['heading' => 'Số vi phạm nghiệp vụ', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'week_completed' => '3','month_completed' => '4', 'color' => 'text-danger', 'icon' => 'bi-exclamation-octagon-fill'])
    
                            {{-- Số sự cố CCDC --}}
                            @include('template.components.KeyIndex.elementCard', ['heading' => 'Số sự cố CCDC', 'heading_mini' => 'Phát sinh / Đã xử lý', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'today_total' => '3', 'week_completed' => '2', 'week_total' => '3','month_completed' => '2', 'month_total' => '3', 'separate' => '/', 'space' => 'letter-spacing: -1px;', 'icon' => 'bi-x-octagon-fill'])
                        </div>
                    </div>
    
                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        {{-- Số khoản chi tiêu mua sắm --}}
                        @include('template.components.KeyIndex.elementCardTwo', ['heading' => 'Số khoản chi tiêu mua sắm', 'heading_mini' => 'Khoản: trị giá', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '3', 'today_total' => '32M', 'week_completed' => '6', 'week_total' => '62M','month_completed' => '9', 'month_total' => '92M', 'separate' => ':', 'color_after' => 'text-black', 'icon' => 'bi-cash-stack'])
                    </div>
    
                    <div class="sidebarBody_wrapper mt-4  col-6 col-md-12">
                        {{-- Tuyển dụng --}}
                        @include('template.components.KeyIndex.elementCardTwo', ['heading' => 'Tuyển dụng', 'heading_mini' => 'Phát sinh / Đã tuyển', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'today_total' => '3', 'week_completed' => '22', 'week_total' => '30','month_completed' => '10', 'month_total' => '160', 'separate' => '/', 'icon' => 'bi-person-plus-fill'])
                    </div>
    
                    <div class="sidebarBody_wrapper mt-4  col-6 col-md-12">
                        {{-- Huấn luyện & Đánh giá --}}
                        @include('template.components.KeyIndex.elementCardTwo', ['heading' => 'Huấn luyện & Đánh giá', 'heading_mini' => 'Yêu cầu / Hoàn thành', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'today_total' => '1', 'week_completed' => '22', 'week_total' => '20','month_completed' => '40', 'month_total' => '30', 'separate' => '/', 'icon' => 'bi-yelp'])
                    </div>
    
                    <div class="sidebarBody_wrapper mt-4  col-6 col-md-12">
                        {{-- Kiểm soát NV & CV --}}
                        @include('template.components.KeyIndex.elementCardTwo', ['heading' => 'Kiểm soát NV & CV', 'title_today' => 'Hôm nay', 'title_week' => 'Tuần này', 'title_month' => 'Tháng này', 'today_completed' => '2', 'today_total' => '1', 'week_completed' => '22', 'week_total' => '20','month_completed' => '40', 'month_total' => '30', 'separate' => '/' , 'icon' => 'bi-fingerprint'])
                    </div>

                    @else
                    <div class="sidebarBody_wrapper">
                        <div class="sidebarBody_card" style="line-height: 16px; min-height: 165px; overflow-y: scroll">
                            <div class="data_chart">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="Số lượng xe" class="data_chart-items">
                                            <canvas id="dash"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        <div class="sidebarBody_card bg-pink-blur" style="line-height: 16px; max-height:165px; height:100%; overflow-y: scroll">
                            <div class="sidebarBody_heading-wrapper">
                                <h6 class="sidebarBody_heading mt-1">Chỉ số công việc đơn vị</h6>
                            </div>
                            {{-- @include('template.components.KeyIndex.elementCardMini') --}}
                            <div class="sidebarBody_cardmini-wrapper" style="line-height: 2">
                                <div class="sidebarBody_cardmini">
                                    <span class="sidebarBody_card-title">
                                        <i class="bi bi-file-earmark-text"></i>
                                        Báo cáo kế hoạch lắp ráp theo sản phẩm
                                    </span>
                                    <strong>2/<span class="text-success">2</span></strong>
                                </div>                              
                                <div class="sidebarBody_cardmini">
                                    <span class="sidebarBody_card-title">
                                        <i class="bi bi-file-earmark-text"></i>
                                        Kiểm tra máy móc, thiết bị
                                    </span>
                                    <strong>2/<span class="text-success">2</span></strong>
                                </div>
                                <div class="sidebarBody_cardmini">
                                    <span class="sidebarBody_card-title">
                                        <i class="bi bi-file-earmark-text"></i>
                                        Số sản phẩm hoàn thành
                                    </span>
                                    <strong>2/<span class="text-success">3</span></strong>
                                </div>
                                <div class="sidebarBody_cardmini">
                                    <span class="sidebarBody_card-title">
                                        <i class="bi bi-file-earmark-text"></i>
                                        Số sản phẩm hỏng/lỗi
                                    </span>
                                    <strong>2</strong>
                                </div>
                                <div class="sidebarBody_cardmini">
                                    <span class="sidebarBody_card-title">
                                        <i class="bi bi-file-earmark-text"></i>
                                        Báo cáo lượng linh kiện tồn kho
                                    </span>
                                    <strong>2/<span class="text-success">2</span></strong>
                                </div>                                                                  
                            </div>
                        </div>
                    </div>    
                                        
                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        <div class="sidebarBody_card" style="height:100%">
                            <div class="sidebarBody_heading-wrapper">
                                <h6 class="sidebarBody_heading mt-1">                                
                                    <i class="bi bi-ev-front-fill"></i>                        
                                    Sản phẩm                         
                                    <span class="sidebarBody_heading-mini text-black">(Sản phẩm-Thời gian)</span>
                                </h6>
                            
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless text-right" style="margin: 0">
                                    <thead>
                                        <tr>
                                            <th style="padding: 0; width:35%; text-align: left">Năng suất</th>
                                            <th style="padding: 0; width:35%; text-align: left">Nhân công</th>
                                            <th style="padding: 0; width:35%; text-align: left">Chi phí</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                        
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">1 SP</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate">:</span>
                                                    <span class="sidebarBody_card-body-subtitle-before">10 MD</span>
                                                </span>
                                            </td>
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">3 máy</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate">:</span>
                                                    <span class="sidebarBody_card-body-subtitle-before">10 N</span>
                                                </span>
                                            </td>
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">60M</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate"></span>
                                                    <span class="sidebarBody_card-body-subtitle-after"></span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>                                                                             
                                </table>                            
                            </div>
                        </div>
                    </div> 
                    
                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        <div class="sidebarBody_card" style="height:100%">
                            <div class="sidebarBody_heading-wrapper">
                                <h6 class="sidebarBody_heading mt-1">                                
                                    <i class="bi bi-gear"></i>                        
                                    Linh kiện tồn kho                        
                                    <span class="sidebarBody_heading-mini text-black"></span>
                                </h6>
                            
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless text-right" style="margin: 0">
                                    <thead>
                                        <tr>
                                            <th style="padding: 0; width:35%; text-align: left">Số lượng</th>
                                            <th style="padding: 0; width:35%; text-align: left">Chi phí</th>
                                            <th style="padding: 0; width:30%; text-align: left">Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                        
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">150</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate"></span>
                                                    <span class="sidebarBody_card-body-subtitle-before"></span>
                                                </span>
                                            </td>
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">200M</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate"></span>
                                                    <span class="sidebarBody_card-body-subtitle-before"></span>
                                                </span>
                                            </td>
                                            <td style="font-weight: 700; padding: 0; text-align: left">
                                                <span class="sidebarBody_card-body-subtitle">
                                                    <span class="sidebarBody_card-body-subtitle-before">3M</span>
                                                   <span class="sidebarBody_card-body-subtitle-separate"></span>
                                                    <span class="sidebarBody_card-body-subtitle-after"></span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>                                                                             
                                </table>                            
                            </div>
                        </div>
                    </div>  
                    
                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        {{-- Huấn luyện & Đánh giá --}}
                        @include('template.components.KeyIndex.elementCardTwo', [
                            'heading' => 'Quản lý công việc',
                            'heading_mini' => 'Nhiệm vụ hoàn thành',
                            'title_today' => 'Hôm nay',
                            'title_week' => 'Tuần này',
                            'title_month' => 'Tháng này',
                            'today_completed' => '2',
                            'today_total' => '3',
                            'week_completed' => '22',
                            'week_total' => '30',
                            'month_completed' => '50',
                            'month_total' => '100',
                            'separate' => '/',
                            'icon' => 'bi-pencil-square',
                        ])
                    </div>    

                    <div class="sidebarBody_wrapper mt-4 col-6 col-md-12">
                        {{-- Huấn luyện & Đánh giá --}}
                        @include('template.components.KeyIndex.elementCardTwo', [
                            'heading' => 'Vấn đề cần xử lý',
                            'heading_mini' => 'Tồn đọng & phát sinh',
                            'title_today' => 'Hôm nay',
                            'title_week' => 'Tuần này',
                            'title_month' => 'Tháng này',
                            'today_completed' => '2',
                            'today_total' => '3',
                            'week_completed' => '22',
                            'week_total' => '30',
                            'month_completed' => '50',
                            'month_total' => '100',
                            'separate' => '/',
                            'icon' => 'bi-search',
                        ])
                    </div>
                                       
                    <div class="sidebarBody_wrapper mt-4">
                        <div class="sidebarBody_card bg-blue-blur">
                            <div class="sidebarBody_heading-wrapper">
                                <h6 class="sidebarBody_heading mt-2 mb-2">
                                    Báo cáo tuần
                                </h6>
                            </div>
                            <div class="sidebarBody_card-items-pdf">
                                <div class="sidebarBody_card-items-wrapper mb-2 d-flex align-items-start justify-content-between">
                                    <div class="sidebarBody_card-items-left">
                                        <div class="sidebarBody_card-posts">
                                            <span
                                                >1. Báo cáo</span
                                            >
                                        </div>
                                        <div class="sidebarBody_card-description">
                                            <div class="sidebarBody_card-text">
                                                Mô tả:
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="sidebarBody_card-items-wrapper mb-2 d-flex align-items-start justify-content-between">
                                    <div class="sidebarBody_card-items-left">
                                        <div class="sidebarBody_card-posts">
                                            <span
                                                >2. Báo cáo</span
                                            >
                                        </div>
                                        <div class="sidebarBody_card-description">
                                            <div class="sidebarBody_card-text">
                                                Mô tả
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="sidebarBody_card-items-wrapper mb-2 d-flex align-items-start justify-content-between">
                                    <div class="sidebarBody_card-items-left">
                                        <div class="sidebarBody_card-posts">
                                            <span
                                                >3. Báo cáo</span
                                            >
                                        </div>
                                        <div class="sidebarBody_card-description">
                                            <div class="sidebarBody_card-text">
                                                Mô tả
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                                    
                            </div>
    
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        <div style="height:64px;"></div>
        </div>
        <span id="btn-right"><i class="bi bi-arrow-bar-right"></i>
        </span>
    </div>
</div>
