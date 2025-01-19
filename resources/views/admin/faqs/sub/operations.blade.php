<div class="tableActions">
    <a class="btn" href="{{route('admin.faqs.edit', ['faq' => $instance->id])}}">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <g id="Group_55532" transform="translate(0 -4)">
                    <g id="Edit_Square" data-name="Edit Square">
                        <path id="Edit_Square-2" data-name="Edit Square" d="M5.657,20A5.465,5.465,0,0,1,0,14.336L0,14.1V5.937C0,2.542,2.163.149,5.428.041l.23,0H9.335a.736.736,0,0,1,.1,1.466l-.1.006H5.657A4,4,0,0,0,1.48,5.7l0,.234V14.1c0,2.608,1.528,4.324,3.959,4.423l.223,0h8.678a3.994,3.994,0,0,0,4.18-4.192l0-.235V10.146a.737.737,0,0,1,1.468-.1l.007.1V14.1c0,3.4-2.156,5.789-5.429,5.9l-.23,0ZM6,14.659A.738.738,0,0,1,5.26,13.9l.093-3.712a2.855,2.855,0,0,1,.841-1.955L13.542.9A3.088,3.088,0,0,1,17.9.9l1.2,1.2a3.073,3.073,0,0,1,0,4.352l-7.385,7.372a2.856,2.856,0,0,1-2.031.841Zm1.238-5.38a1.389,1.389,0,0,0-.409.95l-.075,2.956H9.681a1.406,1.406,0,0,0,.886-.316l.1-.093L16.406,7.05,12.938,3.587ZM17.449,6.008l.6-.6a1.6,1.6,0,0,0,0-2.268l-1.2-1.194a1.609,1.609,0,0,0-2.273,0l-.6.6Z" fill="#103349"/>
                    </g>
                </g>
            </svg>
        </span>
    </a>
    <a class="svg-icon" data-kt-docs-table-filter="delete_row" data-action="{{route('admin.faqs.destroy', ['faq'=> $instance->id])}}">
        <svg data-kt-docs-table-filter="delete_row" data-action="{{route('admin.faqs.destroy', ['faq'=> $instance->id])}}" xmlns="http://www.w3.org/2000/svg" width="19.28" height="19.28" viewBox="0 0 19.28 19.28">
            <path d="M655.316,1822.892h-3.431a.964.964,0,0,1-.915-.658l-.3-.916a1.927,1.927,0,0,0-1.829-1.318h-4.395a1.925,1.925,0,0,0-1.829,1.319l-.3.914a.963.963,0,0,1-.915.659h-3.43a.964.964,0,0,0,0,1.928h1.027l.724,10.86a3.865,3.865,0,0,0,3.847,3.6h6.157a3.866,3.866,0,0,0,3.847-3.6l.724-10.86h1.026a.964.964,0,0,0,0-1.928Zm-10.873-.964h4.395l.3.916c.006.017.014.032.021.049h-5.046c.006-.017.015-.033.021-.05Zm7.2,13.624a1.933,1.933,0,0,1-1.924,1.8h-6.157a1.933,1.933,0,0,1-1.924-1.8l-.714-10.732h.472a2.917,2.917,0,0,0,.306-.024.842.842,0,0,0,.121.024h9.64a1.01,1.01,0,0,0,.121-.024,2.9,2.9,0,0,0,.306.024h.472Zm-2.11-6.876v4.82a.964.964,0,1,1-1.928,0v-4.82a.964.964,0,0,1,1.928,0Zm-3.856,0v4.82a.964.964,0,1,1-1.928,0v-4.82a.964.964,0,0,1,1.928,0Z" transform="translate(-637 -1820)" fill="#103349"/>
        </svg>
    </a>
</div>