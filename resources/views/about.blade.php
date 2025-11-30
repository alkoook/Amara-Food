<x-front-layout title="About US">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8 md:p-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">{{ __('About Us') }} </h1>
            
            @php
                $companyOverview = \App\Models\Setting::getValue('company_overview', '');
            @endphp

            @if($companyOverview)
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($companyOverview)) !!}
                </div>
            @else
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            <p class="text-lg mb-6">{!! __('Welcome to <strong>AmaraFood</strong>, a leading food company in United Kingdoom.') !!}</p>
            <p class="mb-6">{!! __('We offer a wide range of high-quality food products that meet the needs of our customers. We always strive to provide the best services and products that ensure your satisfaction.') !!}</p>
            <p class="mb-6">{!! __('Our vision is to be the first choice for our customers in the food sector by offering high-quality products and excellent customer service.') !!}</p>
            <p>{!! __('We are committed to high-quality standards and ensure that all our products meet the highest health and food standards.') !!}</p>
                </div>
            @endif
        </div>
    </div>
</x-front-layout>

