<x-front-layout title="من نحن">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8 md:p-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">من نحن</h1>
            
            @php
                $companyOverview = \App\Models\Setting::getValue('company_overview', '');
            @endphp

            @if($companyOverview)
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($companyOverview)) !!}
                </div>
            @else
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <p class="text-lg mb-6">
                        مرحباً بكم في <strong>AmaraFood</strong>، شركة رائدة في مجال المواد الغذائية في سوريا.
                    </p>
                    <p class="mb-6">
                        نحن نقدم مجموعة واسعة من المنتجات الغذائية عالية الجودة التي تلبي احتياجات عملائنا. نسعى دائماً لتقديم أفضل الخدمات والمنتجات التي تضمن رضاكم.
                    </p>
                    <p class="mb-6">
                        رؤيتنا هي أن نكون الخيار الأول لعملائنا في مجال المواد الغذائية من خلال تقديم منتجات عالية الجودة وخدمة عملاء ممتازة.
                    </p>
                    <p>
                        نلتزم بمعايير الجودة العالية ونضمن أن جميع منتجاتنا تلبي أعلى المعايير الصحية والغذائية.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-front-layout>

