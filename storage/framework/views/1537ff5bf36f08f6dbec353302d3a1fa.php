<?php $__env->startSection('content'); ?>
    <section class="homepage">
        <div class="widget-placeholder">
            <!-- Header Section -->
            <?php if (isset($component)) { $__componentOriginala718393f51bb1a77c69f5c0896d0866a = $component; } ?>
<?php $component = App\View\Components\User\Header::resolve(['title' => 'Events'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\User\Header::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala718393f51bb1a77c69f5c0896d0866a)): ?>
<?php $component = $__componentOriginala718393f51bb1a77c69f5c0896d0866a; ?>
<?php unset($__componentOriginala718393f51bb1a77c69f5c0896d0866a); ?>
<?php endif; ?>

            <div class="hkdevs-wdgt-section">
                <!-- Content Section -->
                <section class="text-gray-600 body-font">

                    <div class="container lg:px-24 md:px-12 py-6 mx-auto flex flex-wrap">
                        <!-- Event List Block -->
                        <div class="lg:w-3/4 w-full mb-10 lg:mb-0 overflow-hidden px-2">
                            <!-- Event List Filter -->
                            <div class="flex flex-wrap items-center justify-between card overflow-hidden px-2 mb-3">
                                <div>
                                    <span class="text-sm">Showing Result <strong class="text-purple-600">10</strong> of <strong  class="text-purple-600"><?php echo e(rand(10,99)); ?></strong> Events</span>
                                </div>
                                <div class="flex flex-wrap items-center justify-center">
                                    <label for="sort-by">Sort By</label>
                                    <select id="sort-by"
                                            class="border border-solid border-gray-300 text-gray-900 text-sm w-auto p-2.5 m-2 focus:outline-none focus:border-0 card">
                                        <option selected>Filter All</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                    </select>
                                    <label for="price-range">Price Range</label>
                                    <select name="price-range" id="price-range"
                                            class="border border-solid border-gray-300 text-gray-900 text-sm w-auto p-2.5 m-2 focus:outline-none focus:border-0 card    ">
                                        <option value="low-tot-high">Low to High</option>
                                        <option value="high-to-low">High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Event List -->
                            <div class="flex flex-col mb-10 lg:items-center items-center justify-center">
                                <!-- Event list Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-2">
                                    <!-- Event Items-->
                                    <?php
                                        function generateRandomEventTitle(): string {
                                            $eventTypes = ["Conference", "Seminar", "Workshop", "Webinar", "Exhibition", "Symposium", "Panel Discussion", "Networking Event", "Hackathon", "Meetup"];
                                            $topics = ["Technology", "Business", "Science", "Art", "Health", "Education", "Environment", "Finance", "Sports", "Music"];

                                            $randomEventType = $eventTypes[array_rand($eventTypes)];
                                            $randomTopic = $topics[array_rand($topics)];

                                            return $randomEventType . " on " . $randomTopic;
                                        }
                                    ?>

                                    <?php for($i=1; $i<10;$i++): ?>
                                        <div class="card desktop-homepage-events-wdgt overflow-hidden">
                                            <img class="w-full h-40 object-cover"
                                                 src="https://via.placeholder.com/300x300"
                                                 alt="Event Thumbnail">
                                            <div class="card-body">
                                                <div class="organizer-container flex items-start">
                                                    <div class="organizer-logo-container">
                                                        <img alt="company logo" class="logo-img"
                                                             height="100" width="100"
                                                             src="https://via.placeholder.com/100x100">
                                                    </div>
                                                    <div class="organizer-description-container ml-3">
                                                        <p class="feature-card-heading"><?php echo e(generateRandomEventTitle()); ?></p>
                                                        <p class="feature-card-organizer"><?php echo e(generateRandomEventTitle()); ?></p>
                                                    </div>
                                                </div>
                                                <div class="chips-container mt-2">
                                                    <div class="chip">
                                                        <p class="chip-label"><?php echo e(generateRandomEventTitle()); ?></p>
                                                    </div>
                                                </div>
                                                <div class="feature-card-stats-container mt-2 flex items-center">
                                                    <div class="feature-card-date-container flex items-center">
                                                        <img alt="User icon" class="naukicon-calendar"
                                                             height="16" width="16"
                                                             src="https://static.naukimg.com/s/0/0/i/Events/icons/calendar-ot.svg">
                                                        <?php
                                                            $randomTimestamp = rand(strtotime('2023-01-01 00:00:00'), strtotime('2023-12-31 23:59:59'));
                                                            $randomDate = date('d M, g:i A', $randomTimestamp);
                                                        ?>
                                                        <p class="feature-card-date-label ml-1"><?php echo e($randomDate); ?></p>
                                                    </div>
                                                    <div class="registered-user-container ml-4 flex items-center">
                                                        <img alt="User icon" class="naukicon-user"
                                                             height="16" width="16"
                                                             src="https://static.naukimg.com/s/0/0/i/Events/icons/user-ot.svg">
                                                        <p class="registered-count-label ml-1"><?php echo e(rand(1,99) / 10); ?>K
                                                            Enrolled</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="footer-separator"></div>
                                                <div
                                                    class="semi-circle-container flex items-center justify-between">
                                                    <div class="left semi-circle"></div>
                                                    <div class="right semi-circle"></div>
                                                </div>
                                                <div
                                                    class="card-footer-container flex items-center justify-between">
                                                    <div class="feature-card-type-tag-container">
                                                        <p class="feature-card-type-label">RS. <?php echo e(rand(99,999)); ?></p>
                                                    </div>
                                                    <div class="cta-container">
                                                        <a href="<?php echo e(route('view.event', [generateRandomEventTitle()])); ?>"
                                                           class="text-purple-500 hover:text-white hover:bg-purple-500 rounded-full px-2 py-2 hover:bg-purple-600 transition duration-300 ease-in-out text-xs"
                                                           style="border: 1px solid;">View Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <!-- Pagination -->
                            <?php if (isset($component)) { $__componentOriginal9713b3c0f0505c6f78c60e7ef61c5467 = $component; } ?>
<?php $component = App\View\Components\User\Pagination::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user.pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\User\Pagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9713b3c0f0505c6f78c60e7ef61c5467)): ?>
<?php $component = $__componentOriginal9713b3c0f0505c6f78c60e7ef61c5467; ?>
<?php unset($__componentOriginal9713b3c0f0505c6f78c60e7ef61c5467); ?>
<?php endif; ?>
                        </div>
                        <!-- Side Block -->
                        <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </section>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main-user-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hacki\OneDrive\Desktop\Business Directory\Admin\resources\views/pages/user/event/list.blade.php ENDPATH**/ ?>